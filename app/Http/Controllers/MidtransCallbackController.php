<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendUserPasswordMail;
use Illuminate\Support\Facades\Mail;

class MidtransCallbackController extends Controller
{
    public function receive(Request $request)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $notification = new \Midtrans\Notification();
        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $fraudStatus = $notification->fraud_status;

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if (!$transaction->user_id) {
                $password = Str::random(8);

                $user = User::create([
                    'name' => $transaction->customer_name,
                    'email' => $transaction->customer_email,
                    'password' => bcrypt($password),
                ]);

                Mail::to($user->email)->send(new SendUserPasswordMail($user, $password));

                $transaction->user_id = $user->id;
                $transaction->save();
            }
        }

        return response()->json(['message' => 'Callback handled']);
    }
}

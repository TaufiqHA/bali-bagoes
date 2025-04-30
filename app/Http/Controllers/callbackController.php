<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendUserPasswordMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

class callbackController extends Controller
{
    public function terima($id)
    {
        $transaction = Transaction::orderBy('created_at', 'desc')->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $password = Str::random(8);

                $user = User::create([
                    'name' => $transaction->customer_name,
                    'email' => $transaction->customer_email,
                    'password' => bcrypt($password),
                ]);

                Mail::to($user->email)->send(new SendUserPasswordMail($user, $password));

                $transaction->user_id = $user->id;
                $transaction->save();

        $invoice = Invoice::find($id);
        $invoice['status'] = 'sukses';
        $invoice->save();

        return view('invoices.success', ['auth' => $user, 'password' => $password]);
    }
}

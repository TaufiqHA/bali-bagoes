<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\PaymentGatewaySetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentGatewaySettingResource\Pages;
use App\Filament\Resources\PaymentGatewaySettingResource\RelationManagers;

class PaymentGatewaySettingResource extends Resource
{
    protected static ?string $model = PaymentGatewaySetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('gateway_name')
                    ->label('Payment Gateway')
                    ->required(),
                    Forms\Components\Section::make('Production Environment Settings')
                    ->schema([
                        Forms\Components\TextInput::make('production_merchant_id'),
                        Forms\Components\TextInput::make('production_client_id'),
                        Forms\Components\TextInput::make('production_client_key'),
                        Forms\Components\TextInput::make('production_server_key'),
                        Forms\Components\TextInput::make('production_secret_key'),
                        Forms\Components\TextInput::make('production_public_key'),
                        Forms\Components\TextInput::make('production_private_key'),
                        Forms\Components\TextInput::make('production_merchant_key'),
                        Forms\Components\TextInput::make('production_api_key'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('use_sandbox')
                            ->required()
                            ->live(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Sandbox Environment Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sandbox_merchant_id')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_client_id')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_client_key')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_server_key')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_secret_key')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_public_key')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_private_key')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_merchant_key')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                        Forms\Components\TextInput::make('sandbox_api_key')
                            ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                    ])
                    ->columns(2)
                    ->hidden(fn (Get $get): bool => ! $get('use_sandbox')),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gateway_name')
                    ->label('Payment Gateway'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('use_sandbox')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentGatewaySettings::route('/'),
            'create' => Pages\CreatePaymentGatewaySetting::route('/create'),
            'edit' => Pages\EditPaymentGatewaySetting::route('/{record}/edit'),
        ];
    }
}

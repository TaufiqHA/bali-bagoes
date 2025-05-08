<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Products;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use App\Filament\Resources\ProductsResource\RelationManagers;
use Filament\Forms\Components\TextInput;

class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Products';

    protected static ?string $label = 'Master Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\FileUpload::make('pictures')
                    ->label('Gambar')
                    ->image()
                    ->directory('image'),
                Forms\Components\RichEditor::make('descriptions') 
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                MoneyInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->decimals(0)
                    ->prefix('Rp')
                    ->extraAttributes([
                        'x-data' => '{}',
                        'x-init' => "
                            let input = \$el;
                            input.addEventListener('input', function() {
                                let raw = input.value.replace(/[^0-9]/g, '');
                                if (raw === '') return input.value = '';
                                let formatted = new Intl.NumberFormat('id-ID').format(raw);
                                input.value = formatted;
                            });
                        ",
                        'inputmode' => 'numeric',
                    ])
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : '')
                    ->dehydrateStateUsing(fn ($state) => (int) preg_replace('/\D/', '', $state)),
                MoneyInput::make('price_correct')
                    ->label('Harga Coret')
                    ->required()
                    ->decimals(0)
                    ->prefix('Rp')
                    ->extraAttributes([
                        'x-data' => '{}',
                        'x-init' => "
                            let input = \$el;
                            input.addEventListener('input', function() {
                                let raw = input.value.replace(/[^0-9]/g, '');
                                if (raw === '') return input.value = '';
                                let formatted = new Intl.NumberFormat('id-ID').format(raw);
                                input.value = formatted;
                            });
                        ",
                        'inputmode' => 'numeric',
                    ])
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : '')
                    ->dehydrateStateUsing(fn ($state) => (int) preg_replace('/\D/', '', $state)),
                TextInput::make('fee_sell')
                    ->label('Pendapatan Office')
                    ->required()
                    ->numeric()
                    ->prefix('%')
                    ->extraAttributes([
                        'x-data' => '{}',
                        'x-init' => "
                            let input = \$el;
                            input.addEventListener('input', function() {
                                let raw = input.value.replace(/[^0-9]/g, '');
                                if (raw === '') return input.value = '';
                                let formatted = new Intl.NumberFormat('id-ID').format(raw);
                                input.value = formatted;
                            });
                        ",
                        'inputmode' => 'numeric',
                    ])
                    ->formatStateUsing(function ($state, $get) {
                        $priceCorrect = (int) preg_replace('/\D/', '', $get('price') ?? 0);
                        if ($priceCorrect > 0) {
                            return number_format(($state / $priceCorrect) * 100, 0, ',', '.');
                        }
                        return $state;
                    })
                    ->dehydrateStateUsing(function ($state, $get) {
                        $priceCorrect = (int) preg_replace('/\D/', '', $get('price') ?? 0);
                        $percentage = (int) preg_replace('/\D/', '', $state);
                        return intval(($priceCorrect * $percentage) / 100);
                    }),
                TextInput::make('fee_partner')
                    ->label('Pendapatan Partner')
                    ->required()
                    ->numeric()
                    ->prefix('%')
                    ->extraAttributes([
                        'x-data' => '{}',
                        'x-init' => "
                            let input = \$el;
                            input.addEventListener('input', function() {
                                let raw = input.value.replace(/[^0-9]/g, '');
                                if (raw === '') return input.value = '';
                                let formatted = new Intl.NumberFormat('id-ID').format(raw);
                                input.value = formatted;
                            });
                        ",
                        'inputmode' => 'numeric',
                    ])
                    ->formatStateUsing(function ($state, $get) {
                        $priceCorrect = (int) preg_replace('/\D/', '', $get('price') ?? 0);
                        if ($priceCorrect > 0) {
                            return number_format(($state / $priceCorrect) * 100, 0, ',', '.');
                        }
                        return $state;
                    })
                    ->dehydrateStateUsing(function ($state, $get) {
                        $priceCorrect = (int) preg_replace('/\D/', '', $get('price') ?? 0);
                        $percentage = (int) preg_replace('/\D/', '', $state);
                        return intval(($priceCorrect * $percentage) / 100);
                    }),
                Forms\Components\FileUpload::make('file')
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('pictures')
                    ->label('Gambar'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fee_sell')
                    ->label('Pendapatan Office')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fee_partner')
                    ->label('Pendapatan Partner')
                    ->money('idr')
                    ->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}

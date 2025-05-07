<?php

namespace App\Filament\Pages;

use App\Settings\PageSettings;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

use function Laravel\Prompts\textarea;

class HomepageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = PageSettings::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('brand')
                    ->label('Nama Brand'),
                TextInput::make('heading')
                    ->label('Header'),
                Textarea::make('description')
                    ->label('Deskripsi')
            ])
            ->columns(1);
    }
}

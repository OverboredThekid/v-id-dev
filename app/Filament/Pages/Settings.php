<?php

namespace App\Filament\Pages;

use App\Settings\BadgeSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;


class Settings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = BadgeSettings::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('qrcode_link')
            ->label('QR Code Link')
            ->required(),
            DatePicker::make('exp_date')->label('Badge Exp. Date')
            ->required(),
            Toggle::make('is_redirect')->label('QR Code Redirect')->disabled()
        ];
    }
}

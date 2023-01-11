<?php

namespace App\Filament\Pages;

use App\Settings\BadgeSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class ManageBage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = BadgeSettings::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('qr_link')->require()->url()->prefix('https://')->suffix('.com'),
            DatePicker::make('exp_date')->require(),
            Toggle::make('is_redirect')->require()
        ];
    }
}

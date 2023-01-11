<?php

namespace App\Filament\Pages;

use App\Settings\BadgeSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class ManageBadge extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = BadgeSettings::class;

    protected static ?string $navigationGroup = 'System';


    protected function getFormSchema(): array
    {
        return [
            TextInput::make('qr_link')->required()->url()->label('Card QR Link'),
            DatePicker::make('exp_date')->required()->label('Card Experation Date'),
            Toggle::make('is_redirect')->required()->label('Is Redirecting')
        ];
    }
}

<?php

namespace App\Filament\Pages;

use App\Settings\BadgeSettings;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = BadgeSettings::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('qr_link')->required()->url()->label('Card QR Link'),
            DatePicker::make('exp_date')->required()->label('Card Experation Date'),
            Toggle::make('is_redirect')->required()->label('Link Redirecting'),
            SpatieMediaLibraryFileUpload::make('svg_file_front')->required()->label("Front Of ID"),
            SpatieMediaLibraryFileUpload::make('svg_file_back')->required()->label('Back Of ID'),

        ];
    }
}

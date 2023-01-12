<?php

namespace App\Filament\Pages;

use App\Settings\BadgeSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;


class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = BadgeSettings::class;

    protected function getFormSchema(): array
    {
        return [
            Section::make('Card Details')
                ->description('Manage The changing values for "Card Maker"')
                ->schema([
                    TextInput::make('qr_link')->required()->url()->label('Redirecting Link')->hint('Set the path of the Landing Page for the QR Code'),
                    DatePicker::make('exp_date')->required()->label('Card Experation Date')->minDate(now()->subMonths(3))->maxDate(now()->addMonths(3))->hint('Set The EXP. Date on the Badge, can only Set 4 Months ahead'),
                    Toggle::make('is_redirect')->required()->label('Link Redirecting')->hint('Redirect QR Code to "Redirecting Link" or Custom Page (Coming Soon!)'),
                ]),
            Section::make('SVG File')
                ->description('Upload Front and Back SVG files for the print')
                ->schema([
                    FileUpload::make('svg_front')->required()->label('Card Front')->directory('svg'),
                    FileUpload::make('svg_back')->required()->label('Card Back')->directory('svg'),
                ])

        ];
    }
}

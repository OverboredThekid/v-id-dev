<?php

namespace App\Filament\Pages;

use App\Forms\Components\svgIdsSave;
use App\Settings\BadgeSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\ViewField;


class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'System';

    protected static string $settings = BadgeSettings::class;

    protected function getFormSchema(): array
    {
        return [
            Section::make('Card Details')
                ->description('Manage The changing values for "Card Maker"')
                ->schema([
                    Toggle::make('is_redirect')->required()->label('Link Redirecting')->hint('Redirect QR Code to "Redirecting Link" or Custom Page (Coming Soon!)')->disabled(),
                    TextInput::make('qr_link')->required()->url()->label('Redirecting Link')->hint('Set the path of the Landing Page for the QR Code'),
                    FileUpload::make('site_logo')->required()->label('Site logo')->directory('site_logo'),
                    FileUpload::make('site_logo_big')->required()->label('Site logo Big')->directory('site_logo_big'),
                ]),
            Section::make('SVG File')
                ->description('Upload Front and Back SVG files for the print')
                ->schema([
                    FileUpload::make('svg_front')->required()->label('Card Front')->directory('svg'),
                    FileUpload::make('svg_back')->required()->label('Card Back')->directory('svg'),
                ]),
              svgIdsSave::make('svgIdsSave')->label("Save SVG ID's"),
        ];
    }

}

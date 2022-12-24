<?php

namespace App\Filament\Resources;

use Beier\FilamentPages\Filament\Resources\FilamentPageResource;
use Filament\Forms\Components\Toggle;

class PageResource extends FilamentPageResource
{
    public static function insertAfterSecondaryColumnSchema(): array
    {
        return [
            Toggle::make('is_index'),
            Toggle::make('is_QrPage'),

        ];
    }
}
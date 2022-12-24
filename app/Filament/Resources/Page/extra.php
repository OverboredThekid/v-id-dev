<?php

namespace App\Filament\Resources;

use Beier\FilamentPages\Filament\Resources\FilamentPageResource;
use Filament\Forms\Components\Toggle;

class extra extends FilamentPageResource
{
    /**
     * Recommended: Insert Fields at the end of the secondary column. (sidebar)
     */
    public static function insertAfterSecondaryColumnSchema(): array
    {

        return [
            Toggle::make('is_QrPage')->label('Landing Page'),
            Toggle::make('is_index')->label('Index')
        ];
    }

    }
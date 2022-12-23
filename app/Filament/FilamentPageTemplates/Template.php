<?php

namespace App\Filament\FilamentPageTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\Card;
use Ekremogul\FilamentGrapesjs\Forms\Components\GrapesJs;

class Template implements FilamentPageTemplate
{
    public static function title(): string
    {
        return 'GrapeJs';
    }

    public static function schema(): array
    {
        return [
            Card::make()
                ->schema([
                    GrapesJs::make('content')
                    ->label(__('Content')),
                ]),
        ];
    }
}
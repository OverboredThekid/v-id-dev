<?php

namespace App\Filament\FilamentPageTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\Card;
use FilamentEditorJs\Forms\Components\EditorJs;

class TemplateEditor implements FilamentPageTemplate
{
    public static function title(): string
    {
        return 'TemplateEditor';
    }

    public static function schema(): array
    {
        return [
            Card::make()
                ->schema([
                    EditorJs::make('content')
                    ->label(__('Content')),
                ]),
        ];
    }
}
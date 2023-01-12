<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\staff;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Navigation\NavigationItem;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\Action;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;


class StaffResource extends Resource
{
    protected static ?string $model = staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Card-Maker';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name'),
                        TextInput::make('email')->email(),
                        TextInput::make('phone')->tel(),
                        Toggle::make('is_active')
                            ->onColor('success')
                            ->offColor('danger')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone')->searchable(),
                ToggleColumn::make('is_active')
            ])
            ->filters([
                Filter::make('is_active')->label('Active')->toggle()
            ])
            ->actions([
                Action::make('Visit')->label('Visit')->url(fn (staff $record): string => route('staff', $record->id))->openUrlInNewTab()->icon('heroicon-o-link')->color('warning'), 
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make('export')->exports([
                    ExcelExport::make()
                        ->askForFilename()
                        ->askForWriterType()
                        ->allFields()
                ])
            ])
            
            ->headerActions([ 
                ExportAction::make('export')->exports([
                    ExcelExport::make()
                        ->askForFilename()
                        ->askForWriterType()
                        ->allFields()
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\StaffPrintsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}

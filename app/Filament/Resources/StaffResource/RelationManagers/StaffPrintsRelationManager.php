<?php

namespace App\Filament\Resources\StaffResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\IconColumn;
use App\Models\staff_prints;
use Filament\Tables\Actions\Action;


class StaffPrintsRelationManager extends RelationManager
{
    protected static string $relationship = 'staff_prints';

    protected static ?string $recordTitleAttribute = 'staff_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    SpatieMediaLibraryFileUpload::make('staff_img')->collection('staff_prints')->label("Staff Photo"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('staff_id'),
                IconColumn::make('is_active')
                ->boolean()
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Printed'),
                SpatieMediaLibraryImageColumn::make('staff_img')->collection('staff_print'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Print')->label('Print')->url(fn (staff_prints $record): string => route('svg', $record))->openUrlInNewTab()->icon('heroicon-o-printer')->color('danger'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}

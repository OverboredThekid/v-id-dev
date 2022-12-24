<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffPrintResource\Pages;
use App\Filament\Resources\StaffPrintResource\RelationManagers;
use App\Models\staff_prints;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use FilamentCurator\Forms\Components\MediaUpload;
use FilamentCurator\Tables\Columns\CuratorColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class StaffPrintResource extends Resource
{
    protected static ?string $model = staff_prints::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Card-Maker';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count('is_active', '0');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('staff_img')->collection('staff_prints'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('staff.name')->searchable()->label('Name'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Printed'),
                SpatieMediaLibraryImageColumn::make('staff_img')->collection('staff_print'),
                ])
            ->filters([
                TernaryFilter::make('is_active')->label('Has Printed')
            ])   
            ->actions([
                Action::make('Print')->label('Print')->url(fn (staff_prints $record): string => route('svg', $record))->openUrlInNewTab()->icon('heroicon-o-printer')->color('danger'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStaffPrints::route('/'),
            'create' => Pages\CreateStaffPrint::route('/create'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VeloResource\Pages;
use App\Filament\Resources\VeloResource\RelationManagers;
use App\Models\Velo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VeloResource extends Resource
{
    protected static ?string $model = Velo::class;
    protected static ?string $pluralModelLabel = 'Вело 2023';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->label('Техника'),
                Tables\Columns\TextColumn::make('phone')
                ->sortable()
                ->searchable()
                ->label('Номер'),
                Tables\Columns\TextColumn::make('oplata')
                ->sortable()
                ->searchable()
                ->label('Старт способ'),
                Tables\Columns\TextColumn::make('money')
                ->sortable()
                ->searchable()
                ->label('Оплата'),
                Tables\Columns\TextColumn::make('oplata_dop')
                ->sortable()
                ->searchable()
                ->label('Старт способ'),
                Tables\Columns\TextColumn::make('doplata')
                ->sortable()
                ->searchable()
                ->label('Оплата'),
                Tables\Columns\TextColumn::make('title')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Имя'),
                Tables\Columns\TextColumn::make('family')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Фамилия'),
                Tables\Columns\TextColumn::make('date')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Дата'),
                Tables\Columns\TextColumn::make('time_go')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('На сколько'),
                Tables\Columns\TextColumn::make('who_add')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Добавил'),
                Tables\Columns\TextColumn::make('who_stop')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Остановил'),
                Tables\Columns\TextColumn::make('comment')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Коммент старт'),
            ])
            ->filters([
                SelectFilter::make('Техника')
                ->relationship('velos','name')
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListVelos::route('/'),
            'create' => Pages\CreateVelo::route('/create'),
            'edit' => Pages\EditVelo::route('/{record}/edit'),
        ];
    }
}

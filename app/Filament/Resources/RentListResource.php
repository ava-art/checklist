<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentListResource\Pages;
use App\Filament\Resources\RentListResource\RelationManagers;
use App\Models\RentList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RentListResource extends Resource
{
    protected static ?string $model = RentList::class;
    protected static ?int $navigationSort = 4;

    protected static ?string $pluralModelLabel = 'Поездки';

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
                Tables\Columns\ImageColumn::make('photo')
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Фото'),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->searchable()
                    ->label('Категория'),
                Tables\Columns\TextColumn::make('client.phone')
                    ->sortable()
                    ->searchable()
                    ->label('Номер'),
                Tables\Columns\TextColumn::make('element.name')
                    ->sortable()
                    ->searchable()
                    ->label('Техника'),
                Tables\Columns\TextColumn::make('comment_start')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Комментарий старт'),
                Tables\Columns\TextColumn::make('comment_stop')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Комментарий стоп'),
                ColumnGroup::make('Оплата старт', [
                    Tables\Columns\TextColumn::make('money_pay_start')
                        ->hidden(!auth()->user()->role === 'admins')
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->label('Оплата'),
                    Tables\Columns\TextColumn::make('sposob_pay_start')
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->label('Способ'),
                ]),
                ColumnGroup::make('Оплата стоп', [
                Tables\Columns\TextColumn::make('money_pay_stop')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->hidden(!auth()->user()->role === 'admins')
                    ->label('Доплата'),
                Tables\Columns\TextColumn::make('sposob_pay_stop')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Способ'),
                ]),
                Tables\Columns\TextColumn::make('who_start')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Отпустил'),
                Tables\Columns\TextColumn::make('who_stop')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Принял'),
                Tables\Columns\TextColumn::make('time_start')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Старт'),
                Tables\Columns\TextColumn::make('time_stop')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Стоп'),
                Tables\Columns\TextColumn::make('date_start')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Старт'),
                Tables\Columns\TextColumn::make('date_stop')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Стоп'),
                Tables\Columns\TextColumn::make('pause_start')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Пауза страт'),
                Tables\Columns\TextColumn::make('time_update')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Обновлено'),
                Tables\Columns\TextColumn::make('money_full_drive')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Накатали'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->hidden(!auth()->user()->role === 'admins'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->hidden(!auth()->user()->role === 'admins')
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
            'index' => Pages\ListRentLists::route('/'),
        ];
    }
}

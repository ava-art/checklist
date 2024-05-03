<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientsResource\Pages;
use App\Filament\Resources\ClientsResource\RelationManagers;
use App\Models\Clients;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientsResource extends Resource
{
    protected static ?string $model = Clients::class;
    protected static ?int $navigationSort = 3;

    protected static ?string $pluralModelLabel = 'Клиенты';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
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
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Фото'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('family')
                    ->sortable()
                    ->searchable()
                    ->label('Фамилия'),
                Tables\Columns\TextColumn::make('phone')
                    ->sortable()
                    ->searchable()
                    ->label('Номер'),
                Tables\Columns\TextColumn::make('who_add')
                    ->sortable()
                    ->label('Добавил')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('comment')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Комментарий'),
                Tables\Columns\TextColumn::make('date')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Дата'),
                Tables\Columns\TextColumn::make('count_bonus')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Бонусов'),
                IconColumn::make('postoyannik')
                    ->sortable()
                    ->boolean()
                    ->label('Постоянник'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListClients::route('/'),
        ];
    }
}

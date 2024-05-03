<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ElementsResource\Pages;
use App\Filament\Resources\ElementsResource\RelationManagers;
use App\Models\Elements;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ElementsResource extends Resource
{
    protected static ?string $model = Elements::class;
    protected static ?string $pluralModelLabel = 'Техника';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(25),
                Forms\Components\TextInput::make('name_en')->required(),
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->native(false),
                Forms\Components\ColorPicker::make('color')->default(' '),
                Forms\Components\TextInput::make('sort')->tel()->required(),
                Forms\Components\TextInput::make('qr')->tel(),
                Forms\Components\FileUpload::make('image')
                    ->nullable()
                    ->image()
                    ->imageResizeMode('cover')
                    ->directory('/photos/element')
                    ->imageResizeTargetWidth('500'),
                Forms\Components\TextInput::make('transmissia')->default(' '),
                Forms\Components\TextInput::make('koleso')->tel(),
                Forms\Components\TextInput::make('rama')->maxLength(10)->default(' '),
                Forms\Components\TextInput::make('go'),
                Forms\Components\TextInput::make('repair')->default(' '),
                Forms\Components\TextInput::make('shield')->default(' '),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->label('Фото'),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->label('Категория'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(isIndividual:true)
                    ->label('Название'),
                Tables\Columns\TextColumn::make('name_en')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Полное название'),
                Tables\Columns\ColorColumn::make('color')
                    ->label('Цвет'),
                Tables\Columns\TextColumn::make('sort')
                    ->sortable()
                    ->label('Сортировка'),
                Tables\Columns\TextColumn::make('qr')
                    ->sortable()
                    ->label('QR'),
                Tables\Columns\TextColumn::make('transmissia')
                    ->label('Трансмиссия')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('koleso')
                    ->sortable()
                    ->label('Диаметр колёс')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('rama')
                    ->label('Размер рамы')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('go')
                    ->label('Статус')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('repair')
                    ->sortable()
                    ->label('Ремонт')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('shield')
                    ->label('Бронь')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->hidden(!auth()->user()->role === 'admins')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->hidden(!auth()->user()->role === 'admins'),
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
            'index' => Pages\ListElements::route('/'),
        ];
    }
}

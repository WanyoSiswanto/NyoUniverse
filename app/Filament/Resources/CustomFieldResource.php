<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomFieldResource\Pages;
use App\Models\CustomField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomFieldResource extends Resource
{
    protected static ?string $model = CustomField::class;
    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('messages.custom_fields');
    }

    public static function getModelLabel(): string
    {
        return __('messages.custom_field');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category')
                    ->options([
                        'calibration' => __('messages.calibration'),
                        'qualification' => __('messages.qualification'),
                        'mapping' => __('messages.mapping'),
                    ])
                    ->required()
                    ->label(__('messages.category')),
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->regex('/^[a-z0-9_]+$/')
                    ->unique(ignoreRecord: true)
                    ->label(__('messages.field_key'))
                    ->hint(__('messages.use_snake_case')),
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->label(__('messages.field_label')),
                Forms\Components\Select::make('type')
                    ->options([
                        'text' => __('messages.text'),
                        'number' => __('messages.number'),
                        'date' => __('messages.date'),
                        'textarea' => __('messages.textarea'),
                    ])
                    ->required()
                    ->default('text')
                    ->label(__('messages.field_type')),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->label(__('messages.display_order')),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->label(__('messages.category')),
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->label(__('messages.field_key')),
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->label(__('messages.field_label')),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->label(__('messages.field_type')),
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->label(__('messages.order')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'calibration' => __('messages.calibration'),
                        'qualification' => __('messages.qualification'),
                        'mapping' => __('messages.mapping'),
                    ])
                    ->label(__('messages.category')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomFields::route("/"),
            'create' => Pages\CreateCustomField::route("/create"),
            'edit' => Pages\EditCustomField::route("/{record}/edit"),
        ];
    }
}

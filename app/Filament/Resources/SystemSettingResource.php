<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemSettingResource\Pages;
use App\Models\SystemSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SystemSettingResource extends Resource
{
    protected static ?string $model = SystemSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('messages.system_settings');
    }

    public static function getModelLabel(): string
    {
        return __('messages.system_settings');
    }

    public static function canCreate(): bool
    {
        return SystemSetting::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('messages.general_settings'))
                    ->schema([
                        Forms\Components\Select::make('timezone')
                            ->options(array_combine(
                                DateTimeZone::listIdentifiers(),
                                DateTimeZone::listIdentifiers()
                            ))
                            ->searchable()
                            ->default('Asia/Jakarta')
                            ->label(__('messages.timezone')),
                        Forms\Components\Select::make('date_format')
                            ->options([
                                'd/m/Y' => 'DD/MM/YYYY',
                                'm/d/Y' => 'MM/DD/YYYY',
                                'Y-m-d' => 'YYYY-MM-DD',
                                'd-m-Y' => 'DD-MM-YYYY',
                            ])
                            ->default('d/m/Y')
                            ->label(__('messages.date_format')),
                        Forms\Components\Select::make('number_format')
                            ->options([
                                'id' => 'Indonesian (1.000,00)',
                                'en' => 'English (1,000.00)',
                            ])
                            ->default('id')
                            ->label(__('messages.number_format')),
                        Forms\Components\Select::make('language')
                            ->options([
                                'en' => 'English',
                                'id' => 'Bahasa Indonesia',
                            ])
                            ->default('id')
                            ->required()
                            ->label(__('messages.default_language')),
                        Forms\Components\TextInput::make('active_year')
                            ->numeric()
                            ->default(now()->year)
                            ->required()
                            ->label(__('messages.active_year')),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('timezone')
                    ->label(__('messages.timezone')),
                Tables\Columns\TextColumn::make('date_format')
                    ->label(__('messages.date_format')),
                Tables\Columns\TextColumn::make('language')
                    ->badge()
                    ->label(__('messages.language')),
                Tables\Columns\TextColumn::make('active_year')
                    ->label(__('messages.active_year')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('messages.updated_at')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystemSettings::route("/"),
            'create' => Pages\CreateSystemSetting::route("/create"),
            'edit' => Pages\EditSystemSetting::route("/{record}/edit"),
        ];
    }
}

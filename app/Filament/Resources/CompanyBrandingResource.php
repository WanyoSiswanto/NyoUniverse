<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyBrandingResource\Pages;
use App\Models\CompanyBranding;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanyBrandingResource extends Resource
{
    protected static ?string $model = CompanyBranding::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('messages.company_branding');
    }

    public static function getModelLabel(): string
    {
        return __('messages.company_branding');
    }

    public static function canCreate(): bool
    {
        return CompanyBranding::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('messages.company_info'))
                    ->schema([
                        Forms\Components\TextInput::make('company_name')
                            ->required()
                            ->default('NyoUniverse')
                            ->label(__('messages.company_name')),
                        Forms\Components\FileUpload::make('logo_path')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->label(__('messages.logo')),
                        Forms\Components\Textarea::make('address')
                            ->label(__('messages.address')),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('messages.phone')),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label(__('messages.email')),
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->label(__('messages.website')),
                        Forms\Components\TextInput::make('department_name')
                            ->label(__('messages.department_name')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.report_settings'))
                    ->schema([
                        Forms\Components\Textarea::make('report_footer')
                            ->label(__('messages.report_footer')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')
                    ->disk('public')
                    ->label(__('messages.logo')),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable()
                    ->label(__('messages.company_name')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('messages.email')),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('messages.phone')),
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
            'index' => Pages\ListCompanyBranding::route("/"),
            'create' => Pages\CreateCompanyBranding::route("/create"),
            'edit' => Pages\EditCompanyBranding::route("/{record}/edit"),
        ];
    }
}

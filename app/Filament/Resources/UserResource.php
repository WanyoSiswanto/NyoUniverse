<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('messages.users');
    }

    public static function getModelLabel(): string
    {
        return __('messages.user');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('messages.user_info'))
                    ->schema([
                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label(__('messages.username')),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label(__('messages.name')),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->nullable()
                            ->label(__('messages.email')),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->label(__('messages.password')),
                        Forms\Components\TextInput::make('department')
                            ->nullable()
                            ->label(__('messages.department')),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => __('messages.pending'),
                                'active' => __('messages.active'),
                                'rejected' => __('messages.rejected'),
                                'inactive' => __('messages.inactive'),
                            ])
                            ->required()
                            ->default('pending')
                            ->label(__('messages.status')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.roles'))
                    ->schema([
                        Forms\Components\Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->options(fn () => Role::pluck('name', 'id'))
                            ->preload()
                            ->label(__('messages.assigned_roles')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->sortable()
                    ->label(__('messages.username')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('messages.name')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(__('messages.email')),
                Tables\Columns\TextColumn::make('department')
                    ->searchable()
                    ->label(__('messages.department')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        'inactive' => 'gray',
                        default => 'gray',
                    })
                    ->label(__('messages.status')),
                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->label(__('messages.roles')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('messages.created_at')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => __('messages.pending'),
                        'active' => __('messages.active'),
                        'rejected' => __('messages.rejected'),
                        'inactive' => __('messages.inactive'),
                    ])
                    ->label(__('messages.status')),
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
            'index' => Pages\ListUsers::route("/"),
            'create' => Pages\CreateUser::route("/create"),
            'edit' => Pages\EditUser::route("/{record}/edit"),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}

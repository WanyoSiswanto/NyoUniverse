<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterMappingResource\Pages;
use App\Models\CustomField;
use App\Models\MasterMapping;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MasterMappingResource extends Resource
{
    protected static ?string $model = MasterMapping::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('messages.mapping');
    }

    public static function getModelLabel(): string
    {
        return __('messages.mapping_item');
    }

    public static function form(Form $form): Form
    {
        $customFields = CustomField::where('category', 'mapping')->orderBy('order')->get();

        $customSchema = [];
        foreach ($customFields as $field) {
            $component = match ($field->type) {
                'number' => Forms\Components\TextInput::make("custom_fields.{$field->key}")
                    ->numeric()
                    ->label($field->label),
                'date' => Forms\Components\DatePicker::make("custom_fields.{$field->key}")
                    ->label($field->label),
                'textarea' => Forms\Components\Textarea::make("custom_fields.{$field->key}")
                    ->label($field->label),
                default => Forms\Components\TextInput::make("custom_fields.{$field->key}")
                    ->label($field->label),
            };
            $customSchema[] = $component;
        }

        return $form
            ->schema([
                Forms\Components\Section::make(__('messages.basic_info'))
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label(__('messages.code')),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label(__('messages.name')),
                        Forms\Components\TextInput::make('location')
                            ->label(__('messages.location')),
                        Forms\Components\TextInput::make('department')
                            ->label(__('messages.department')),
                        Forms\Components\Select::make('criticality')
                            ->options(MasterMapping::CRITICALITY_OPTIONS)
                            ->required()
                            ->default('major')
                            ->label(__('messages.criticality')),
                        Forms\Components\Select::make('frequency')
                            ->options(MasterMapping::FREQUENCY_OPTIONS)
                            ->required()
                            ->default('12')
                            ->label(__('messages.frequency')),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->label(__('messages.is_active')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.room_specs'))
                    ->schema([
                        Forms\Components\TextInput::make('room_dimensions')
                            ->label(__('messages.room_dimensions')),
                        Forms\Components\TextInput::make('standard_points')
                            ->numeric()
                            ->label(__('messages.standard_points')),
                        Forms\Components\TextInput::make('temp_min_spec')
                            ->numeric()
                            ->label(__('messages.temp_min_spec')),
                        Forms\Components\TextInput::make('temp_max_spec')
                            ->numeric()
                            ->label(__('messages.temp_max_spec')),
                        Forms\Components\TextInput::make('rh_min_spec')
                            ->numeric()
                            ->label(__('messages.rh_min_spec')),
                        Forms\Components\TextInput::make('rh_max_spec')
                            ->numeric()
                            ->label(__('messages.rh_max_spec')),
                        Forms\Components\TextInput::make('vendor')
                            ->label(__('messages.vendor')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.custom_fields'))
                    ->schema($customSchema)
                    ->columns(2)
                    ->visible(count($customSchema) > 0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label(__('messages.code')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('messages.name')),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->label(__('messages.location')),
                Tables\Columns\TextColumn::make('department')
                    ->searchable()
                    ->label(__('messages.department')),
                Tables\Columns\TextColumn::make('criticality')
                    ->badge()
                    ->label(__('messages.criticality')),
                Tables\Columns\TextColumn::make('frequency')
                    ->formatStateUsing(fn (string $state): string => MasterMapping::FREQUENCY_OPTIONS[$state] ?? $state)
                    ->label(__('messages.frequency')),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label(__('messages.active')),
                Tables\Columns\TextColumn::make('temp_min_spec')
                    ->numeric(2)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('messages.temp_min_spec')),
                Tables\Columns\TextColumn::make('temp_max_spec')
                    ->numeric(2)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('messages.temp_max_spec')),
                Tables\Columns\TextColumn::make('vendor')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('messages.vendor')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('messages.created_at')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('criticality')
                    ->options(MasterMapping::CRITICALITY_OPTIONS)
                    ->label(__('messages.criticality')),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('messages.active')),
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
            'index' => Pages\ListMasterMappings::route("/"),
            'create' => Pages\CreateMasterMapping::route("/create"),
            'edit' => Pages\EditMasterMapping::route("/{record}/edit"),
        ];
    }
}

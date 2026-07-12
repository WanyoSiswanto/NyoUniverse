<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExecutionMappingResource\Pages;
use App\Models\ExecutionMapping;
use App\Models\ProgramMapping;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ExecutionMappingResource extends Resource
{
    protected static ?string $model = ExecutionMapping::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Execution';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('messages.mapping_executions');
    }

    public static function getModelLabel(): string
    {
        return __('messages.mapping_execution');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('messages.program_info'))
                    ->schema([
                        Forms\Components\Select::make('program_id')
                            ->relationship('program', 'id')
                            ->options(function () {
                                return ProgramMapping::with('master')
                                    ->where('status', 'approved')
                                    ->get()
                                    ->mapWithKeys(function ($program) {
                                        return [$program->id => "{$program->master->code} - {$program->master->name} ({$program->year})"];
                                    });
                            })
                            ->searchable()
                            ->required()
                            ->label(__('messages.program')),
                    ]),

                Forms\Components\Section::make(__('messages.execution_details'))
                    ->schema([
                        Forms\Components\DatePicker::make('execution_date')
                            ->required()
                            ->label(__('messages.execution_date')),
                        Forms\Components\Select::make('result')
                            ->options(ExecutionMapping::RESULT_OPTIONS)
                            ->required()
                            ->label(__('messages.result')),
                        Forms\Components\Textarea::make('notes')
                            ->nullable()
                            ->label(__('messages.notes')),
                        Forms\Components\FileUpload::make('file_link')
                            ->disk('public')
                            ->directory('mapping-evidence')
                            ->preserveFilenames()
                            ->label(__('messages.evidence_file')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.mapping_details'))
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label(__('messages.start_date')),
                        Forms\Components\DatePicker::make('end_date')
                            ->label(__('messages.end_date')),
                        Forms\Components\TextInput::make('points_installed')
                            ->numeric()
                            ->label(__('messages.points_installed')),
                    ])
                    ->columns(3),

                Forms\Components\Section::make(__('messages.temperature_humidity'))
                    ->schema([
                        Forms\Components\TextInput::make('temp_min')
                            ->numeric()
                            ->label(__('messages.temp_min')),
                        Forms\Components\TextInput::make('temp_max')
                            ->numeric()
                            ->label(__('messages.temp_max')),
                        Forms\Components\TextInput::make('rh_min')
                            ->numeric()
                            ->label(__('messages.rh_min')),
                        Forms\Components\TextInput::make('rh_max')
                            ->numeric()
                            ->label(__('messages.rh_max')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.recommendations'))
                    ->schema([
                        Forms\Components\Textarea::make('routine_points_recommendation')
                            ->label(__('messages.routine_points_recommendation')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program.master.code')
                    ->searchable()
                    ->label(__('messages.code')),
                Tables\Columns\TextColumn::make('program.master.name')
                    ->searchable()
                    ->label(__('messages.name')),
                Tables\Columns\TextColumn::make('program.year')
                    ->label(__('messages.year')),
                Tables\Columns\TextColumn::make('execution_date')
                    ->date()
                    ->sortable()
                    ->label(__('messages.execution_date')),
                Tables\Columns\TextColumn::make('result')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pass' => 'success',
                        'fail' => 'danger',
                        'conditional' => 'warning',
                        default => 'gray',
                    })
                    ->label(__('messages.result')),
                Tables\Columns\TextColumn::make('approval_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->label(__('messages.approval_status')),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->label(__('messages.start_date')),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->label(__('messages.end_date')),
                Tables\Columns\TextColumn::make('points_installed')
                    ->label(__('messages.points')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('result')
                    ->options(ExecutionMapping::RESULT_OPTIONS)
                    ->label(__('messages.result')),
                Tables\Filters\SelectFilter::make('approval_status')
                    ->options(ExecutionMapping::APPROVAL_STATUS_OPTIONS)
                    ->label(__('messages.approval_status')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label(__('messages.approve'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (ExecutionMapping $record): bool => $record->approval_status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->form([
                        Forms\Components\Textarea::make('approval_notes')
                            ->label(__('messages.approval_notes')),
                    ])
                    ->action(function (ExecutionMapping $record, array $data): void {
                        $record->update([
                            'approval_status' => 'approved',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                            'approval_notes' => $data['approval_notes'] ?? null,
                        ]);
                    }),
                Tables\Actions\Action::make('reject')
                    ->label(__('messages.reject'))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (ExecutionMapping $record): bool => $record->approval_status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->form([
                        Forms\Components\Textarea::make('approval_notes')
                            ->required()
                            ->label(__('messages.rejection_reason')),
                    ])
                    ->action(function (ExecutionMapping $record, array $data): void {
                        $record->update([
                            'approval_status' => 'rejected',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                            'approval_notes' => $data['approval_notes'] ?? null,
                        ]);
                    }),
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
            'index' => Pages\ListExecutionMappings::route("/"),
            'create' => Pages\CreateExecutionMapping::route("/create"),
            'edit' => Pages\EditExecutionMapping::route("/{record}/edit"),
        ];
    }
}

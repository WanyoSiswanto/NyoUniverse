<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExecutionCalibrationResource\Pages;
use App\Models\ExecutionCalibration;
use App\Models\ProgramCalibration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ExecutionCalibrationResource extends Resource
{
    protected static ?string $model = ExecutionCalibration::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Execution';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('messages.calibration_executions');
    }

    public static function getModelLabel(): string
    {
        return __('messages.calibration_execution');
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
                                return ProgramCalibration::with('master')
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
                            ->options(ExecutionCalibration::RESULT_OPTIONS)
                            ->required()
                            ->label(__('messages.result')),
                        Forms\Components\Textarea::make('notes')
                            ->nullable()
                            ->label(__('messages.notes')),
                        Forms\Components\FileUpload::make('file_link')
                            ->disk('public')
                            ->directory('calibration-evidence')
                            ->preserveFilenames()
                            ->label(__('messages.evidence_file')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.technical_results'))
                    ->schema([
                        Forms\Components\TextInput::make('value_as_found')
                            ->label(__('messages.value_as_found')),
                        Forms\Components\TextInput::make('value_as_left')
                            ->label(__('messages.value_as_left')),
                        Forms\Components\TextInput::make('certificate_number')
                            ->label(__('messages.certificate_number')),
                        Forms\Components\TextInput::make('technician')
                            ->label(__('messages.technician')),
                        Forms\Components\DatePicker::make('vendor_recalibration_date')
                            ->label(__('messages.vendor_recalibration_date')),
                    ])
                    ->columns(2),
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
                Tables\Columns\TextColumn::make('technician')
                    ->searchable()
                    ->label(__('messages.technician')),
                Tables\Columns\TextColumn::make('certificate_number')
                    ->searchable()
                    ->label(__('messages.certificate_number')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('result')
                    ->options(ExecutionCalibration::RESULT_OPTIONS)
                    ->label(__('messages.result')),
                Tables\Filters\SelectFilter::make('approval_status')
                    ->options(ExecutionCalibration::APPROVAL_STATUS_OPTIONS)
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
                    ->visible(fn (ExecutionCalibration $record): bool => $record->approval_status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->form([
                        Forms\Components\Textarea::make('approval_notes')
                            ->label(__('messages.approval_notes')),
                    ])
                    ->action(function (ExecutionCalibration $record, array $data): void {
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
                    ->visible(fn (ExecutionCalibration $record): bool => $record->approval_status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->form([
                        Forms\Components\Textarea::make('approval_notes')
                            ->required()
                            ->label(__('messages.rejection_reason')),
                    ])
                    ->action(function (ExecutionCalibration $record, array $data): void {
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
            'index' => Pages\ListExecutionCalibrations::route("/"),
            'create' => Pages\CreateExecutionCalibration::route("/create"),
            'edit' => Pages\EditExecutionCalibration::route("/{record}/edit"),
        ];
    }
}

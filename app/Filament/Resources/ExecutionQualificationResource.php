<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExecutionQualificationResource\Pages;
use App\Models\ExecutionQualification;
use App\Models\ProgramQualification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ExecutionQualificationResource extends Resource
{
    protected static ?string $model = ExecutionQualification::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationGroup = 'Execution';
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('messages.qualification_executions');
    }

    public static function getModelLabel(): string
    {
        return __('messages.qualification_execution');
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
                                return ProgramQualification::with('master')
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
                            ->options(ExecutionQualification::RESULT_OPTIONS)
                            ->required()
                            ->label(__('messages.result')),
                        Forms\Components\Textarea::make('notes')
                            ->nullable()
                            ->label(__('messages.notes')),
                        Forms\Components\FileUpload::make('file_link')
                            ->disk('public')
                            ->directory('qualification-evidence')
                            ->preserveFilenames()
                            ->label(__('messages.evidence_file')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('messages.protocol_info'))
                    ->schema([
                        Forms\Components\TextInput::make('protocol_number')
                            ->label(__('messages.protocol_number')),
                        Forms\Components\DatePicker::make('protocol_approved_date')
                            ->label(__('messages.protocol_approved_date')),
                        Forms\Components\DatePicker::make('protocol_valid_until')
                            ->label(__('messages.protocol_valid_until')),
                    ])
                    ->columns(3),

                Forms\Components\Section::make(__('messages.report_info'))
                    ->schema([
                        Forms\Components\DatePicker::make('data_completed_date')
                            ->label(__('messages.data_completed_date')),
                        Forms\Components\DatePicker::make('report_created_date')
                            ->label(__('messages.report_created_date')),
                        Forms\Components\TextInput::make('report_number')
                            ->label(__('messages.report_number')),
                        Forms\Components\DatePicker::make('report_approved_date')
                            ->label(__('messages.report_approved_date')),
                        Forms\Components\DatePicker::make('report_valid_until')
                            ->label(__('messages.report_valid_until')),
                    ])
                    ->columns(3),

                Forms\Components\Section::make(__('messages.capa'))
                    ->schema([
                        Forms\Components\Textarea::make('capa')
                            ->label(__('messages.capa_description')),
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
                Tables\Columns\TextColumn::make('protocol_number')
                    ->searchable()
                    ->label(__('messages.protocol_number')),
                Tables\Columns\TextColumn::make('report_number')
                    ->searchable()
                    ->label(__('messages.report_number')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('result')
                    ->options(ExecutionQualification::RESULT_OPTIONS)
                    ->label(__('messages.result')),
                Tables\Filters\SelectFilter::make('approval_status')
                    ->options(ExecutionQualification::APPROVAL_STATUS_OPTIONS)
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
                    ->visible(fn (ExecutionQualification $record): bool => $record->approval_status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->form([
                        Forms\Components\Textarea::make('approval_notes')
                            ->label(__('messages.approval_notes')),
                    ])
                    ->action(function (ExecutionQualification $record, array $data): void {
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
                    ->visible(fn (ExecutionQualification $record): bool => $record->approval_status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->form([
                        Forms\Components\Textarea::make('approval_notes')
                            ->required()
                            ->label(__('messages.rejection_reason')),
                    ])
                    ->action(function (ExecutionQualification $record, array $data): void {
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
            'index' => Pages\ListExecutionQualifications::route("/"),
            'create' => Pages\CreateExecutionQualification::route("/create"),
            'edit' => Pages\EditExecutionQualification::route("/{record}/edit"),
        ];
    }
}

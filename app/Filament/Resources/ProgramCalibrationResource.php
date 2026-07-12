<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramCalibrationResource\Pages;
use App\Models\MasterCalibration;
use App\Models\ProgramCalibration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ProgramCalibrationResource extends Resource
{
    protected static ?string $model = ProgramCalibration::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Programs';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('messages.calibration_programs');
    }

    public static function getModelLabel(): string
    {
        return __('messages.calibration_program');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('master_id')
                    ->relationship('master', 'name')
                    ->options(MasterCalibration::where('is_active', true)->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->label(__('messages.master_item')),
                Forms\Components\TextInput::make('year')
                    ->required()
                    ->numeric()
                    ->default(now()->year)
                    ->label(__('messages.year')),
                Forms\Components\Select::make('planned_month')
                    ->options(array_combine(range(1, 12), [
                        'January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ]))
                    ->required()
                    ->label(__('messages.planned_month')),
                Forms\Components\DatePicker::make('planned_date')
                    ->label(__('messages.planned_date')),
                Forms\Components\Select::make('status')
                    ->options(ProgramCalibration::STATUS_OPTIONS)
                    ->required()
                    ->default('pending')
                    ->label(__('messages.status')),
                Forms\Components\TextInput::make('status_override')
                    ->nullable()
                    ->label(__('messages.status_override')),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('master.code')
                    ->searchable()
                    ->sortable()
                    ->label(__('messages.code')),
                Tables\Columns\TextColumn::make('master.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('messages.name')),
                Tables\Columns\TextColumn::make('year')
                    ->sortable()
                    ->label(__('messages.year')),
                Tables\Columns\TextColumn::make('planned_month')
                    ->formatStateUsing(fn (int $state): string => date('F', mktime(0, 0, 0, $state, 1)))
                    ->label(__('messages.planned_month')),
                Tables\Columns\TextColumn::make('planned_date')
                    ->date()
                    ->label(__('messages.planned_date')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->label(__('messages.status')),
                Tables\Columns\TextColumn::make('submittedBy.name')
                    ->label(__('messages.submitted_by')),
                Tables\Columns\TextColumn::make('approvedBy.name')
                    ->label(__('messages.approved_by')),
                Tables\Columns\TextColumn::make('approved_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('messages.approved_at')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->options(array_combine(range(now()->year - 2, now()->year + 2), range(now()->year - 2, now()->year + 2)))
                    ->label(__('messages.year')),
                Tables\Filters\SelectFilter::make('status')
                    ->options(ProgramCalibration::STATUS_OPTIONS)
                    ->label(__('messages.status')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label(__('messages.approve'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (ProgramCalibration $record): bool => $record->status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->action(function (ProgramCalibration $record): void {
                        $record->update([
                            'status' => 'approved',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                        ]);
                    }),
                Tables\Actions\Action::make('reject')
                    ->label(__('messages.reject'))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (ProgramCalibration $record): bool => $record->status === 'pending' && Auth::user()->hasRole(['admin', 'manager']))
                    ->action(function (ProgramCalibration $record): void {
                        $record->update([
                            'status' => 'rejected',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
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
            'index' => Pages\ListProgramCalibrations::route("/"),
            'create' => Pages\CreateProgramCalibration::route("/create"),
            'edit' => Pages\EditProgramCalibration::route("/{record}/edit"),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\ProgramCalibration;
use App\Models\ProgramQualification;
use App\Models\ProgramMapping;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class UpcomingScheduleWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $year = now()->year;
        $startMonth = now()->month;
        $endMonth = now()->month + 2;

        $calibrationType = str_replace("'", "''", __('messages.calibration'));
        $qualificationType = str_replace("'", "''", __('messages.qualification'));
        $mappingType = str_replace("'", "''", __('messages.mapping'));

        $calibrations = ProgramCalibration::query()
            ->select([
                'program_calibration.id',
                'master_calibration.code as code',
                'master_calibration.name as name',
                DB::raw("'{$calibrationType}' as type"),
                'program_calibration.planned_month as month',
                'program_calibration.planned_date as date',
            ])
            ->join('master_calibration', 'master_calibration.id', '=', 'program_calibration.master_id')
            ->where('program_calibration.year', $year)
            ->where('program_calibration.status', 'approved')
            ->whereBetween('program_calibration.planned_month', [$startMonth, $endMonth]);

        $qualifications = ProgramQualification::query()
            ->select([
                'program_qualification.id',
                'master_qualification.code as code',
                'master_qualification.name as name',
                DB::raw("'{$qualificationType}' as type"),
                'program_qualification.planned_month as month',
                'program_qualification.planned_date as date',
            ])
            ->join('master_qualification', 'master_qualification.id', '=', 'program_qualification.master_id')
            ->where('program_qualification.year', $year)
            ->where('program_qualification.status', 'approved')
            ->whereBetween('program_qualification.planned_month', [$startMonth, $endMonth]);

        $mappings = ProgramMapping::query()
            ->select([
                'program_mapping.id',
                'master_mapping.code as code',
                'master_mapping.name as name',
                DB::raw("'{$mappingType}' as type"),
                'program_mapping.planned_month as month',
                'program_mapping.planned_date as date',
            ])
            ->join('master_mapping', 'master_mapping.id', '=', 'program_mapping.master_id')
            ->where('program_mapping.year', $year)
            ->where('program_mapping.status', 'approved')
            ->whereBetween('program_mapping.planned_month', [$startMonth, $endMonth]);

        $query = ProgramCalibration::query()
            ->fromSub(
                $calibrations->unionAll($qualifications->toBase())->unionAll($mappings->toBase()),
                'upcoming_schedules',
            )
            ->orderBy('month');

        return $table
            ->query(fn () => $query)
            ->heading(__('messages.upcoming_schedules'))
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->label(__('messages.code')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('messages.name')),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->label(__('messages.type')),
                Tables\Columns\TextColumn::make('month')
                    ->formatStateUsing(fn (int $state): string => date('F', mktime(0, 0, 0, $state, 1)))
                    ->label(__('messages.month')),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->label(__('messages.planned_date')),
            ])
            ->paginated(false);
    }
}

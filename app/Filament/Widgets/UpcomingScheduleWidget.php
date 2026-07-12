<?php

namespace App\Filament\Widgets;

use App\Models\ProgramCalibration;
use App\Models\ProgramQualification;
use App\Models\ProgramMapping;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingScheduleWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $calibrations = ProgramCalibration::with('master')
            ->where('year', now()->year)
            ->where('status', 'approved')
            ->whereBetween('planned_month', [now()->month, now()->month + 2])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'calib-' . $item->id,
                    'code' => $item->master->code,
                    'name' => $item->master->name,
                    'type' => __('messages.calibration'),
                    'month' => $item->planned_month,
                    'date' => $item->planned_date,
                ];
            });

        $qualifications = ProgramQualification::with('master')
            ->where('year', now()->year)
            ->where('status', 'approved')
            ->whereBetween('planned_month', [now()->month, now()->month + 2])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'qual-' . $item->id,
                    'code' => $item->master->code,
                    'name' => $item->master->name,
                    'type' => __('messages.qualification'),
                    'month' => $item->planned_month,
                    'date' => $item->planned_date,
                ];
            });

        $mappings = ProgramMapping::with('master')
            ->where('year', now()->year)
            ->where('status', 'approved')
            ->whereBetween('planned_month', [now()->month, now()->month + 2])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'map-' . $item->id,
                    'code' => $item->master->code,
                    'name' => $item->master->name,
                    'type' => __('messages.mapping'),
                    'month' => $item->planned_month,
                    'date' => $item->planned_date,
                ];
            });

        $allItems = $calibrations->concat($qualifications)->concat($mappings)->sortBy('month');

        return $table
            ->query(fn () => \Illuminate\Database\Eloquent\Collection::make($allItems))
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

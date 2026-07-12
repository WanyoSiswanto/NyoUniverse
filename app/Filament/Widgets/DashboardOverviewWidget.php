<?php

namespace App\Filament\Widgets;

use App\Models\MasterCalibration;
use App\Models\MasterQualification;
use App\Models\MasterMapping;
use App\Models\ProgramCalibration;
use App\Models\ProgramQualification;
use App\Models\ProgramMapping;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCalibration = MasterCalibration::where('is_active', true)->count();
        $totalQualification = MasterQualification::where('is_active', true)->count();
        $totalMapping = MasterMapping::where('is_active', true)->count();

        $pendingCalibPrograms = ProgramCalibration::where('status', 'pending')->count();
        $pendingQualPrograms = ProgramQualification::where('status', 'pending')->count();
        $pendingMapPrograms = ProgramMapping::where('status', 'pending')->count();

        return [
            Stat::make(__('messages.calibration_items'), $totalCalibration)
                ->description("{$pendingCalibPrograms} " . __('messages.pending_programs'))
                ->descriptionIcon('heroicon-m-wrench')
                ->color('primary'),
            Stat::make(__('messages.qualification_items'), $totalQualification)
                ->description("{$pendingQualPrograms} " . __('messages.pending_programs'))
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make(__('messages.mapping_items'), $totalMapping)
                ->description("{$pendingMapPrograms} " . __('messages.pending_programs'))
                ->descriptionIcon('heroicon-m-map')
                ->color('warning'),
        ];
    }
}

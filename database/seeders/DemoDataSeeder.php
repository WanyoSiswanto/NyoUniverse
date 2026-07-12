<?php

namespace Database\Seeders;

use App\Models\MasterCalibration;
use App\Models\MasterQualification;
use App\Models\MasterMapping;
use App\Models\ProgramCalibration;
use App\Models\ProgramQualification;
use App\Models\ProgramMapping;
use App\Models\ExecutionCalibration;
use App\Models\ExecutionQualification;
use App\Models\ExecutionMapping;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create technician users
        $tech1 = User::create([
            'username' => 'tech1',
            'name' => 'Technician One',
            'email' => 'tech1@nyouniverse.local',
            'password' => Hash::make('tech123'),
            'department' => 'Engineering',
            'status' => 'active',
        ]);
        $tech1->assignRole('kalibrasi');

        $tech2 = User::create([
            'username' => 'tech2',
            'name' => 'Technician Two',
            'email' => 'tech2@nyouniverse.local',
            'password' => Hash::make('tech123'),
            'department' => 'Validation',
            'status' => 'active',
        ]);
        $tech2->assignRole('kualifikasi');

        // Demo Master Calibration Data
        $calibrations = [
            ['code' => 'CAL-001', 'name' => 'Analytical Balance XPE205', 'location' => 'Lab A', 'department' => 'QC Lab', 'criticality' => 'critical', 'frequency' => '12', 'brand_model' => 'Mettler Toledo XPE205', 'serial_number' => 'SN123456', 'measurement_range' => '0.01-220g', 'tolerance' => '0.0001g', 'execution_type' => 'Internal/External', 'vendor' => 'Mettler Toledo'],
            ['code' => 'CAL-002', 'name' => 'pH Meter SevenExcellence', 'location' => 'Lab B', 'department' => 'QC Lab', 'criticality' => 'critical', 'frequency' => '6', 'brand_model' => 'Mettler Toledo S400', 'serial_number' => 'SN789012', 'measurement_range' => '0-14 pH', 'tolerance' => '0.01 pH', 'execution_type' => 'Internal', 'vendor' => 'Mettler Toledo'],
            ['code' => 'CAL-003', 'name' => 'UV-Vis Spectrophotometer', 'location' => 'Lab C', 'department' => 'R&D', 'criticality' => 'major', 'frequency' => '12', 'brand_model' => 'Shimadzu UV-2600', 'serial_number' => 'SN345678', 'measurement_range' => '185-1400nm', 'tolerance' => '0.5nm', 'execution_type' => 'External', 'vendor' => 'Shimadzu'],
            ['code' => 'CAL-004', 'name' => 'Digital Thermometer', 'location' => 'Warehouse', 'department' => 'Warehouse', 'criticality' => 'minor', 'frequency' => '12', 'brand_model' => 'Testo 110', 'serial_number' => 'SN901234', 'measurement_range' => '-50 to +150C', 'tolerance' => '0.2C', 'execution_type' => 'Internal', 'vendor' => 'Testo'],
            ['code' => 'CAL-005', 'name' => 'Pressure Gauge 0-10 bar', 'location' => 'Production', 'department' => 'Production', 'criticality' => 'major', 'frequency' => '12', 'brand_model' => 'WIKA 232.50', 'serial_number' => 'SN567890', 'measurement_range' => '0-10 bar', 'tolerance' => '0.1 bar', 'execution_type' => 'External', 'vendor' => 'WIKA'],
        ];

        foreach ($calibrations as $data) {
            MasterCalibration::create(array_merge($data, ['is_active' => true]));
        }

        // Demo Master Qualification Data
        $qualifications = [
            ['code' => 'QAL-001', 'name' => 'Autoclave ASTELL 600L', 'location' => 'Sterile Area', 'department' => 'Production', 'criticality' => 'critical', 'frequency' => '12', 'equipment_type' => 'Autoclave', 'manufacturer' => 'Astell', 'model' => 'AMA600', 'serial_number' => 'SN111111', 'capacity' => '600L', 'vendor' => 'Astell Scientific'],
            ['code' => 'QAL-002', 'name' => 'Laminar Air Flow B2', 'location' => 'Filling Room', 'department' => 'Production', 'criticality' => 'critical', 'frequency' => '6', 'equipment_type' => 'LAF', 'manufacturer' => 'Esco', 'model' => 'AC2-4S8', 'serial_number' => 'SN222222', 'capacity' => '4 feet', 'vendor' => 'Esco'],
            ['code' => 'QAL-003', 'name' => 'Walk-in Cold Room', 'location' => 'Warehouse', 'department' => 'Warehouse', 'criticality' => 'major', 'frequency' => '12', 'equipment_type' => 'Cold Room', 'manufacturer' => 'Arctiko', 'model' => 'WIC 40', 'serial_number' => 'SN333333', 'capacity' => '40m3', 'vendor' => 'Arctiko'],
        ];

        foreach ($qualifications as $data) {
            MasterQualification::create(array_merge($data, ['is_active' => true]));
        }

        // Demo Master Mapping Data
        $mappings = [
            ['code' => 'MAP-001', 'name' => 'Warehouse Temperature Mapping', 'location' => 'Raw Material Warehouse', 'department' => 'Warehouse', 'criticality' => 'critical', 'frequency' => '36', 'room_dimensions' => '20m x 15m x 8m', 'standard_points' => 24, 'temp_min_spec' => 15.00, 'temp_max_spec' => 25.00, 'rh_min_spec' => 40.00, 'rh_max_spec' => 60.00, 'vendor' => 'Internal'],
            ['code' => 'MAP-002', 'name' => 'Clean Room Temperature Mapping', 'location' => 'Filling Room Grade B', 'department' => 'Production', 'criticality' => 'critical', 'frequency' => '24', 'room_dimensions' => '10m x 8m x 3m', 'standard_points' => 15, 'temp_min_spec' => 18.00, 'temp_max_spec' => 26.00, 'rh_min_spec' => 45.00, 'rh_max_spec' => 65.00, 'vendor' => 'External'],
            ['code' => 'MAP-003', 'name' => 'Stability Chamber Mapping', 'location' => 'Stability Lab', 'department' => 'QC Lab', 'criticality' => 'major', 'frequency' => '12', 'room_dimensions' => '3m x 2m x 2m', 'standard_points' => 9, 'temp_min_spec' => 24.00, 'temp_max_spec' => 26.00, 'rh_min_spec' => 58.00, 'rh_max_spec' => 62.00, 'vendor' => 'External'],
        ];

        foreach ($mappings as $data) {
            MasterMapping::create(array_merge($data, ['is_active' => true]));
        }

        // Create Programs for current year
        $admin = User::where('username', 'admin')->first();
        $currentYear = now()->year;

        // Calibration Programs
        foreach (MasterCalibration::all() as $master) {
            ProgramCalibration::create([
                'master_id' => $master->id,
                'year' => $currentYear,
                'planned_month' => rand(1, 12),
                'planned_date' => now()->setMonth(rand(1, 12))->setDay(rand(1, 28)),
                'status' => rand(0, 10) > 3 ? 'approved' : 'pending',
                'submitted_by' => $admin->id,
                'approved_by' => rand(0, 10) > 3 ? $admin->id : null,
                'approved_at' => rand(0, 10) > 3 ? now() : null,
            ]);
        }

        // Qualification Programs
        foreach (MasterQualification::all() as $master) {
            ProgramQualification::create([
                'master_id' => $master->id,
                'year' => $currentYear,
                'planned_month' => rand(1, 12),
                'planned_date' => now()->setMonth(rand(1, 12))->setDay(rand(1, 28)),
                'status' => rand(0, 10) > 3 ? 'approved' : 'pending',
                'submitted_by' => $admin->id,
                'approved_by' => rand(0, 10) > 3 ? $admin->id : null,
                'approved_at' => rand(0, 10) > 3 ? now() : null,
            ]);
        }

        // Mapping Programs
        foreach (MasterMapping::all() as $master) {
            ProgramMapping::create([
                'master_id' => $master->id,
                'year' => $currentYear,
                'planned_month' => rand(1, 12),
                'planned_date' => now()->setMonth(rand(1, 12))->setDay(rand(1, 28)),
                'status' => rand(0, 10) > 3 ? 'approved' : 'pending',
                'submitted_by' => $admin->id,
                'approved_by' => rand(0, 10) > 3 ? $admin->id : null,
                'approved_at' => rand(0, 10) > 3 ? now() : null,
            ]);
        }

        // Create some Executions for approved programs
        foreach (ProgramCalibration::where('status', 'approved')->take(3)->get() as $program) {
            ExecutionCalibration::create([
                'program_id' => $program->id,
                'execution_date' => now()->subDays(rand(1, 60)),
                'result' => ['pass', 'pass', 'conditional', 'fail'][rand(0, 3)],
                'notes' => 'Execution completed as scheduled.',
                'value_as_found' => 'Within range',
                'value_as_left' => 'Adjusted',
                'certificate_number' => 'CERT-' . rand(1000, 9999),
                'technician' => 'Technician ' . rand(1, 5),
                'approval_status' => rand(0, 10) > 5 ? 'approved' : 'pending',
                'approved_by' => rand(0, 10) > 5 ? $admin->id : null,
                'approved_at' => rand(0, 10) > 5 ? now() : null,
            ]);
        }

        foreach (ProgramQualification::where('status', 'approved')->take(2)->get() as $program) {
            ExecutionQualification::create([
                'program_id' => $program->id,
                'execution_date' => now()->subDays(rand(1, 60)),
                'result' => ['pass', 'pass', 'conditional'][rand(0, 2)],
                'notes' => 'IQ/OQ completed successfully.',
                'protocol_number' => 'PROTO-' . rand(1000, 9999),
                'protocol_approved_date' => now()->subDays(rand(30, 90)),
                'protocol_valid_until' => now()->addYear(),
                'report_number' => 'REP-' . rand(1000, 9999),
                'approval_status' => rand(0, 10) > 5 ? 'approved' : 'pending',
                'approved_by' => rand(0, 10) > 5 ? $admin->id : null,
                'approved_at' => rand(0, 10) > 5 ? now() : null,
            ]);
        }

        foreach (ProgramMapping::where('status', 'approved')->take(2)->get() as $program) {
            ExecutionMapping::create([
                'program_id' => $program->id,
                'execution_date' => now()->subDays(rand(1, 60)),
                'result' => 'pass',
                'notes' => 'Mapping study completed. All points within specification.',
                'start_date' => now()->subDays(rand(5, 10)),
                'end_date' => now()->subDays(rand(1, 4)),
                'points_installed' => rand(9, 24),
                'temp_min' => rand(1800, 2000) / 100,
                'temp_max' => rand(2300, 2500) / 100,
                'rh_min' => rand(4200, 4500) / 100,
                'rh_max' => rand(5500, 5800) / 100,
                'approval_status' => rand(0, 10) > 5 ? 'approved' : 'pending',
                'approved_by' => rand(0, 10) > 5 ? $admin->id : null,
                'approved_at' => rand(0, 10) > 5 ? now() : null,
            ]);
        }
    }
}

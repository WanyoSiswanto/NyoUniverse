<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        SystemSetting::create([
            'timezone' => 'Asia/Jakarta',
            'date_format' => 'd/m/Y',
            'number_format' => 'id',
            'language' => 'id',
            'active_year' => now()->year,
            'export_defaults' => [
                'include_header' => true,
                'paper_size' => 'A4',
            ],
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyBranding extends Model
{
    protected $table = 'company_branding';

    protected $fillable = [
        'company_name',
        'logo_path',
        'address',
        'phone',
        'email',
        'website',
        'department_name',
        'report_footer',
    ];
}

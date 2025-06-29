<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_by',
        'bgb_region_id',
        'bgb_sec_id',
        'bgb_battalion_id',
        'bgb_coy_id',
        'bgb_bop_id',
        'bsf_region_id',
        'bsf_sec_id',
        'bsf_battalion_id',
        'bsf_coy_id',
        'bsf_bop_id',
        'letter_no',
        'letter_date',
        'ltr_subject',
        'ltr_incident',
        'pillar_id',
        'subpillar_id',
        'distance_from',
        'within_150_km',
        'outside_150_km',
        'killing',
        'injuring',
        'beating',
        'firing',
        'crossing',
    ];
}
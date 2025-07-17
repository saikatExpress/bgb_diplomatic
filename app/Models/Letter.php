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
        'subpillar_type',
        'distance_from',
        'distance_unit',
        'tags',
        'killing',
        'injuring',
        'beating',
        'firing',
        'crossing',
        'status',
    ];

    public function bgb_region()
    {
        return $this->belongsTo(Region::class, 'bgb_region_id', 'id');
    }

    public function bsf_region()
    {
        return $this->belongsTo(Region::class, 'bsf_region_id', 'id');
    }

    public function pillar()
    {
        return $this->belongsTo(Pillar::class, 'pillar_id', 'id');
    }

    public function bgb_sector()
    {
        return $this->belongsTo(Sector::class, 'bgb_sec_id', 'id');
    }

    public function bsf_sector()
    {
        return $this->belongsTo(Sector::class, 'bsf_sec_id', 'id');
    }

    public function bgb_battalion()
    {
        return $this->belongsTo(Battalion::class, 'bgb_battalion_id', 'id');
    }

    public function bsf_battalion()
    {
        return $this->belongsTo(Battalion::class, 'bsf_battalion_id', 'id');
    }

    public function bgb_company()
    {
        return $this->belongsTo(Company::class, 'bgb_coy_id', 'id');
    }

    public function bsf_company()
    {
        return $this->belongsTo(Company::class, 'bsf_coy_id', 'id');
    }

    public function bgb_bop()
    {
        return $this->belongsTo(BOP::class, 'bgb_bop_id', 'id');
    }

    public function bsf_bop()
    {
        return $this->belongsTo(BOP::class, 'bsf_bop_id', 'id');
    }
}
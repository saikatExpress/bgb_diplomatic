<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_by',
        'letter_for',
        'letter_number',
        'reply_no',
        'file_prefix',
        'file_name',
        'file_path',
        'region',
        'sector',
        'battalion',
        'company',
        'bop',
        'status',
    ];

    // Relationship Start
    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letter_number', 'letter_no');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region', 'id');
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector', 'id');
    }
    public function battalion()
    {
        return $this->belongsTo(Battalion::class, 'battalion', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company', 'id');
    }
    public function bop()
    {
        return $this->belongsTo(Bop::class, 'bop', 'id');
    }
    // Relationship End
}
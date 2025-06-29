<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_by',
        'letter_number',
        'file_path',
    ];
}
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
        'status',
    ];
}
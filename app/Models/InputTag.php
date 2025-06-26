<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'input_label',
        'input_name',
        'placeholder',
        'icon',
    ];
}
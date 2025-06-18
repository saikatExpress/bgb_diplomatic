<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LTR extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected function store($request)
    {
        $data = $request->validated();
        return self::create($data);
    }
}

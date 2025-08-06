<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pillar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'lat',
        'lon',
    ];

    public static function store($data)
    {
        self::create($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Pillar created successfully',
            'data'    => $data
        ]);
    }
}
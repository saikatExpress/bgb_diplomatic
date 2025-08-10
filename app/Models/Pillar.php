<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function updateData($data, $pillar)
    {
        $data['name'] = Str::title($data['name']);

        $pillar->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Pillar updated successfully',
            'data'    => $data
        ]);
    }
}
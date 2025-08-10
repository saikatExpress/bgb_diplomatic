<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GRD extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public static function store($data)
    {
        $data['title'] = Str::title($data['title']);
        $data['slug']  = Str::slug($data['title'], '_');

        self::create($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'GRD addedd successfully',
            'data'    => $data
        ]);
    }

    public static function updateData($data, $grd)
    {
        $data['title'] = Str::title($data['title']);
        $data['slug']  = Str::slug($data['title'], '_');

        $grd->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'GRD updated successfully',
            'data'    => $data
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MapSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public static function store($data)
    {
        $data['title'] = Str::title($data['title']);
        $data['slug'] = Str::slug($data['title'], '-');

        self::create($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'MapSheet Created successfully',
            'data'    => $data
        ]);
    }

    public static function updateData($data, $mapsheet)
    {
        $data['title'] = Str::title($data['title']);
        $data['slug'] = Str::slug($data['title'], '-');

        $mapsheet->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'MapSheet Updated successfully',
            'data'    => $data
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GR extends Model
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
            'message' => 'GR added successfully',
            'data'    => $data
        ]);
    }
}
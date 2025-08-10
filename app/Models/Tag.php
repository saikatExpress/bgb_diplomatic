<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'input_name',
    ];

    public static function store($data)
    {
        $createdTags = [];

        foreach ($data['title'] as $index => $title) {
            $tag = Tag::create([
                'title' => Str::title($title),
                'input_name' => Str::slug($data['input_name'][$index], '_'),
            ]);
            $createdTags[] = $tag;
        }

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => count($createdTags) . ' Tag created successfully',
            'data'    => $createdTags
        ]);
    }

    public static function updateTag($tag, $data)
    {
        $data['title'] = Str::title($data['title']);
        $tag->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Tag updated successfully.',
            'data'    => $tag
        ]);
    }
}
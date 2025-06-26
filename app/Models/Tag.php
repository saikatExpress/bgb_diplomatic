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

    protected function store($data)
    {
        $data = [
            'title'      => $data['title'],
            'input_name' => Str::slug($data['input_name'], '_'),
        ];

        self::create($data);

        return redirect()->route('super_admin.tags')->with('success', 'Tag created successfully.');
    }

    protected function updateTag($id, $data)
    {
        $tag = self::findOrFail($id);
        $tag->update($data);

        return redirect()->route('super_admin.tags')->with('success', 'Tag updated successfully.');
    }
}

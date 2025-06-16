<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];
    protected $casts = [
        'status' => 'string',
    ];

    protected function store($request)
    {
        $data = $request->validated();
        return self::create($data);
    }

    public static function updateIncident($request, $id)
    {
        $incident = self::findOrFail($id);
        $data = $request->validated();
        return $incident->update($data);
    }


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'like', '%' . $searchTerm . '%')
                     ->orWhere('description', 'like', '%' . $searchTerm . '%');
    }
}
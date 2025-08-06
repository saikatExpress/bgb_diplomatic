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

    public static function store($data)
    {
        self::create($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Incident create successfully for ' . $data['title'],
            'data'    => $data
        ]);
    }

    public static function updateIncident($data, $incident)
    {
        $incident->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Incident update successfully',
            'data'    => $data
        ]);
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
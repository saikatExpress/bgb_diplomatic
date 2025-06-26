<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPillar extends Model
{
    use HasFactory;

    protected $fillable = [
        'pillar_id',
        'name',
        'type',
    ];

    protected function store($data)
    {
        self::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'SubPillar created successfully',
        ]);
    }

    public function pillar()
    {
        return $this->belongsTo(Pillar::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'code',
        'name',
        'slug',
        'status',
    ];

    protected function store($data)
    {
        $this->create($data);
        return redirect()->route('super_admin.sectors')->with('success', 'Sector created successfully.');
    }

    protected function updateSector($data, $id)
    {
        $sector = self::findOrFail($id);
        $sector->update($data);
        return redirect()->route('super_admin.sectors')->with('success', 'Sector updated successfully.');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sector) {
            $sector->slug = Str::slug($sector->name, '-');
        });

        static::updating(function ($sector) {
            $sector->slug = Str::slug($sector->name, '-');
        });
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

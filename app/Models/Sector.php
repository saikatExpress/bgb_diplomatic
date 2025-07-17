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
        'lat',
        'lon',
        'status',
    ];

    protected function store($data)
    {
        $data['code'] = $this->generateCode();

        $this->create($data);
        return redirect()->route('super_admin.sectors')->with('success', 'Sector created successfully.');
    }

    protected function updateSector($data, $id)
    {
        $sector = self::findOrFail($id);
        $sector->update($data);
        return redirect()->route('super_admin.sectors')->with('success', 'Sector updated successfully.');
    }

    private function generateCode()
    {
        $last = $this->orderBy('id', 'desc')->first();

        if ($last) {
            $nextId = $last->id + 1;
        } else {
            $nextId = 1;
        }

        return 'SEC' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
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
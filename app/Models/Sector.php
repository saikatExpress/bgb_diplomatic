<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function store(array $data)
    {
        $now       = Carbon::now();
        $region_id = $data['region_id'];
        $names     = $data['name'];
        $lats      = $data['lat'] ? $data['lat'] : [];
        $lons      = $data['lon'] ? $data['lon'] : [];

        $sectors = [];

        $nextId = self::generateNextId();

        foreach ($names as $index => $name) {
            $sectors[] = [
                'region_id'  => $region_id,
                'name'       => $name,
                'slug'       => Str::slug($name, '-'),
                'code'       => 'SEC' . str_pad($nextId++, 3, '0', STR_PAD_LEFT),
                'lat'        => $lats[$index] ?? null,
                'lon'        => $lons[$index] ?? null,
                'status'     => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        self::insert($sectors);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => count($sectors) . ' sectors created successfully.',
        ]);
    }

    public static function updateSector($data, $sector)
    {
        $sector->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Sector updated for ' . $sector->name,
            'data'    => $sector
        ]);
    }

    private static function generateNextId()
    {
        $last = self::orderBy('id', 'desc')->first();
        return $last ? $last->id + 1 : 1;
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
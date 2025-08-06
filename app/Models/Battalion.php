<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Battalion extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_id',
        'name',
        'code',
        'lat',
        'lon',
    ];

    public static function store($data)
    {
        $now       = Carbon::now();
        $sector_id = $data['sector_id'];
        $names     = $data['name'];
        $lats      = $data['lat'] ? $data['lat'] : [];
        $lons      = $data['lon'] ? $data['lon'] : [];

        $battalions = [];

        $nextId = self::generateNextId();

        foreach ($names as $index => $name) {
            $battalions[] = [
                'sector_id' => $sector_id,
                'name'       => $name,
                'code'       => 'BAT' . str_pad($nextId++, 3, '0', STR_PAD_LEFT),
                'lat'        => $lats[$index] ?? null,
                'lon'        => $lons[$index] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        self::insert($battalions);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => count($battalions) . ' battalions created successfully.',
        ]);
    }

    public static function updateBattalion($data, $battalion)
    {
        $battalion->update($data);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Battalion update for ' . $data['name'],
            'data'    => $data
        ]);
    }

    private static function generateNextId()
    {
        $last = self::orderBy('id', 'desc')->first();
        return $last ? $last->id + 1 : 1;
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}

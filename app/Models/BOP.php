<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BOP extends Model
{
    use HasFactory;

    protected $fillable = [
        'battalion_id',
        'name',
        'code',
        'lat',
        'lon',
    ];

    public static function store($data)
    {
        $now          = Carbon::now();
        $battalion_id = $data['battalion_id'];
        $names        = $data['name'];
        $lats         = $data['lat'] ? $data['lat'] : [];
        $lons         = $data['lon'] ? $data['lon'] : [];

        $bops = [];

        $nextId = self::generateNextId();

        foreach ($names as $index => $name) {
            $bops[] = [
                'battalion_id' => $battalion_id,
                'name'         => $name,
                'code'         => 'BOP' . str_pad($nextId++, 3, '0', STR_PAD_LEFT),
                'lat'          => $lats[$index] ? $lats[$index] : null,
                'lon'          => $lons[$index] ? $lons[$index] : null,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
        }

        self::insert($bops);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => count($bops) . ' bops created successfully.',
        ]);
    }

    protected function updateBOP($data, $id)
    {
        $bop = self::findOrFail($id);
        $bop->update($data);

        return redirect()->route('super_admin.bops')->with('success', 'BOP updated successfully.');
    }

    protected function destroyBOP($id)
    {
        $bop = self::findOrFail($id);
        $bop->delete();

        return redirect()->route('super_admin.bops')->with('success', 'BOP deleted successfully.');
    }

    private static function generateNextId()
    {
        $last = self::orderBy('id', 'desc')->first();
        return $last ? $last->id + 1 : 1;
    }

    public function battalion()
    {
        return $this->belongsTo(Battalion::class);
    }
}

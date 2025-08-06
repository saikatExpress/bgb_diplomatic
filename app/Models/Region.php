<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'country',
        'name',
        'slug',
        'lat',
        'lon',
        'status',
    ];

    protected function store($data)
    {
        $generatedCode = $this->generateCode($data['country']);

        $this->create([
            'code'    => $generatedCode,
            'country' => $data['country'],
            'name'    => $data['name'],
            'slug'    => Str::slug($data['name'], '-'),
            'lat'     => $data['latitude'],
            'lon'     => $data['longitude'],
            'status'  => 'active',
        ]);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Region created successfully',
            'data'    => $data
        ]);
    }

    private function generateCode($country)
    {
        $prefix = ($country == 'india') ? 'IND' : 'BAN';

        $last = $this->where('code', 'like', $prefix . '%')
                    ->orderBy('id', 'desc')
                    ->first();

        if ($last && preg_match('/(\d+)$/', $last->code, $matches)) {
            $number = (int)$matches[1] + 1;
        } else {
            $number = 1;
        }

        return $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
    }


    protected function updateRegion($data, $region)
    {
        $region->update([
            'country' => $data['country'],
            'name'    => $data['name'],
            'slug'    => Str::slug($data['name'], '-'),
            'lat'     => $data['latitude'],
            'lon'     => $data['longitude'],
            'status'  => 'active',
        ]);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Region updated successfully',
            'data'    => $data
        ]);
    }
}

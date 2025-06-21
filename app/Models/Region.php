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
        'status',
    ];

    protected function store($data)
    {
        $this->create([
            'code'    => ($data['country'] == 'india') ? 'IND'.$data['code'] : 'BAN'.$data['code'],
            'country' => $data['country'],
            'name'    => $data['name'],
            'slug'    => Str::slug($data['name'], '-'),
            'status'  => 'active',
        ]);

        return redirect()->route('super_admin.regions')->with('success', 'Region created successfully.');
    }

    protected function updateRegion($data, $id)
    {
        $region = self::findOrFail($id);
        $region->update([
            'code'    => ($data['country'] == 'india') ? 'IND'.$data['code'] : 'BAN'.$data['code'],
            'country' => $data['country'],
            'name'    => $data['name'],
            'slug'    => Str::slug($data['name'], '-'),
            'status'  => 'active',
        ]);

        return redirect()->route('super_admin.regions')->with('success', 'Region updated successfully.');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battalion extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_id',
        'name',
        'code',
    ];

    protected function store($data)
    {
        $data = array_merge($data, [
            'code' => $this->generateCode($data['sector_id']),
        ]);

        self::create($data);

        return redirect()->route('super_admin.battalions');
    }

    protected function updateBattalion($data, $id)
    {
        $battalion = self::findOrFail($id);

        $battalion->update($data);

        return redirect()->route('super_admin.battalions');
    }

    private function generateCode($sectorId)
    {
        $sector = Sector::find($sectorId);
        if (!$sector) {
            return null;
        }

        $battalionCount = self::where('sector_id', $sectorId)->count() + 2;
        return strtoupper($sector->code . '-' . str_pad($battalionCount, 3, '0', STR_PAD_LEFT));
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}

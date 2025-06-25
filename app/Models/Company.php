<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'battalion_id',
        'name',
        'code',
    ];

    protected function store($data)
    {
        $data['code'] = $this->generateCode($data['battalion_id']);

        self::create($data);

        return redirect()->route('super_admin.companies');
    }

    private function generateCode($battalionId)
    {
        $battalion = Battalion::find($battalionId);
        if (!$battalion) {
            return null;
        }

        $companyCount = self::where('battalion_id', $battalionId)->count() + 2;
        return strtoupper($battalion->code . '-' . str_pad($companyCount, 3, '0', STR_PAD_LEFT));
    }

    protected function updateCompany($data, $id)
    {
        $company = self::findOrFail($id);

        $company->update($data);

        return redirect()->route('super_admin.companies');
    }

    public function battalion()
    {
        return $this->belongsTo(Battalion::class);
    }
}

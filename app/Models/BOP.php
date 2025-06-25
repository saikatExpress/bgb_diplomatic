<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOP extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'code',
    ];

    protected function store($data)
    {
        $data['code'] = $this->generateCode($data['company_id']);
        self::create($data);

        return redirect()->route('super_admin.bops')->with('success', 'BOP created successfully.');
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

    private function generateCode($companyId)
    {
        $company = Company::findOrFail($companyId);
        $bopCount = self::where('company_id', $companyId)->count() + 1;

        return sprintf('%s-%d', $company->code, $bopCount);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

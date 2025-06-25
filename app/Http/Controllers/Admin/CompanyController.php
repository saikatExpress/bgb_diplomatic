<?php

namespace App\Http\Controllers\Admin;

use App\Models\Battalion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $data['companies'] = Company::with('battalion')->get();

        return view('super.partials.companies.index', $data);
    }

    public function create()
    {
        $data['battalions'] = Battalion::all();

        return view('super.partials.companies.create', $data);
    }

    public function store(StoreCompanyRequest $request)
    {
        return Company::store($request->validated());
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $data['battalions'] = Battalion::all();
        $data['company'] = $company;

        return view('super.partials.companies.edit', $data);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        return Company::updateCompany($request->validated(), $id);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('super_admin.companies');
    }
}

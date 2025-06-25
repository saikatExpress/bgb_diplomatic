<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBOPRequest;
use App\Http\Requests\UpdateBOPRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BOP;

class BOPController extends Controller
{
    public function index()
    {
        $data['bops'] = BOP::with('company')->get();

        return view('super.partials.bops.index', $data);
    }

    public function create()
    {
        $data['companies'] = Company::all();

        return view('super.partials.bops.create', $data);
    }

    public function store(StoreBOPRequest $request)
    {
        return BOP::store($request->validated());
    }

    public function edit($id)
    {
        $data['companies'] = Company::all();
        $data['bop'] = BOP::findOrFail($id);

        return view('super.partials.bops.edit', $data);
    }

    public function update(UpdateBOPRequest $request, $id)
    {
        return BOP::updateBOP($request->validated(), $id);
    }

    public function destroy($id)
    {
        return BOP::destroyBOP($id);
    }
}

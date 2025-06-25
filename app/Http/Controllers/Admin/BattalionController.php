<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBattalionRequest;
use App\Http\Requests\updateBattalionRequest;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Battalion;

class BattalionController extends Controller
{
    public function index()
    {
        $data['battalions'] = Battalion::with('sector')->get();
        return view('super.partials.battalions.index', $data);
    }

    public function create()
    {
        $data['sectors'] = Sector::all();

        return view('super.partials.battalions.create', $data);
    }

    public function store(StoreBattalionRequest $request)
    {
        return Battalion::store($request->validated());
    }

    public function edit($id)
    {
        $data['battalion'] = Battalion::findOrFail($id);
        $data['sectors'] = Sector::all();

        return view('super.partials.battalions.edit', $data);
    }

    public function update(updateBattalionRequest $request, $id)
    {
        return Battalion::updateBattalion($request->validated(), $id);
    }

    public function destroy($id)
    {
        $battalion = Battalion::findOrFail($id);
        $battalion->delete();
        return redirect()->route('super_admin.battalions');
    }
}

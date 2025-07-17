<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends Controller
{
    public function index()
    {
        $data['regions'] = Region::all();
        return view('super.partials.regions.index', $data);
    }
    public function create()
    {
        $data['regions'] = Region::all();

        return view('super.partials.regions.create', $data);
    }
    public function store(StoreRegionRequest $request)
    {
        return Region::store($request->validated());
    }
    public function edit($id)
    {
        $region = Region::findOrFail($id);

        return view('super.partials.regions.edit', compact('region'));
    }
    public function update(UpdateRegionRequest $request, $id)
    {
        return Region::updateRegion($request->validated(), $id);
    }
    public function destroy($id)
    {
        // Logic to delete a region
        $region = Region::findOrFail($id);
        $region->delete();

        return redirect()->route('super_admin.regions')->with('success', 'Region deleted successfully.');
    }
    public function show($id)
    {
        // Logic to display a single region
        $region = Region::findOrFail($id);
        return view('super.partials.regions.show', compact('region'));
    }
}

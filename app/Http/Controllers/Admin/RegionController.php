<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $query = Region::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        $data['regions'] = $query->get();

        return view('setting.partials.region.index', $data);
    }

    public function create()
    {
        return view('setting.partials.region.create');
    }
    public function store(StoreRegionRequest $request)
    {
        return Region::store($request->validated());
    }
    public function edit(Region $region)
    {
        return view('setting.partials.region.edit', compact('region'));
    }
    public function update(UpdateRegionRequest $request, Region $region)
    {
        return Region::updateRegion($request->validated(), $region);
    }
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('region.index')->with('success', 'Region deleted successfully.');
    }

    public function show(Region $region)
    {
        return view('setting.partials.region.show', compact('region'));
    }
}

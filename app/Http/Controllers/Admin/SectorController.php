<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectorRequest;
use App\Http\Requests\UpdateSectorRequest;

class SectorController extends Controller
{
    public function index()
    {
        $data['sectors'] = Sector::all();
        return view('setting.partials.sector.index', $data);
    }
    public function create()
    {
        $data['regions'] = Region::all();

        return view('setting.partials.sector.create', $data);
    }
    public function store(StoreSectorRequest $request)
    {
        return Sector::store($request->validated());
    }
    public function edit($id)
    {
        $sector = Sector::findOrFail($id);
        $regions = Region::all();

        return view('setting.partials.sector.edit', compact('sector', 'regions'));
    }
    public function update(UpdateSectorRequest $request, $id)
    {
        return Sector::updateSector($request->validated(), $id);
    }
    public function destroy($id)
    {
        $sector = Sector::findOrFail($id);
        $sector->delete();

        return redirect()->route('super_admin.sectors')->with('success', 'Sector deleted successfully.');
    }
    public function show($id)
    {
        $sector = Sector::findOrFail($id);
        return view('super.partials.sectors.show', compact('sector'));
    }
}

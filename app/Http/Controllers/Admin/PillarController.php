<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePillarRequest;
use App\Http\Requests\UpdatePillarRequest;
use App\Models\Pillar;
use Illuminate\Http\Request;

class PillarController extends Controller
{
    public function index()
    {
        $data['pillars'] = Pillar::latest()->get();
        return view('super.partials.pillar.index', $data);
    }

    public function create()
    {
        $data['pillars'] = Pillar::latest()->take(10)->get();
        return view('super.partials.pillar.create', $data);
    }

    public function store(StorePillarRequest $request)
    {
        Pillar::create($request->validated());

        return redirect()->route('super_admin.pillars.create')->with('success', 'Pillar created successfully.');
    }

    public function edit($id)
    {
        $pillar = Pillar::findOrFail($id);
        return view('super.partials.pillar.edit', compact('pillar'));
    }

    public function update(UpdatePillarRequest $request, $id)
    {
        $pillar = Pillar::findOrFail($id);
        $pillar->update($request->validated());

        return redirect()->route('super_admin.pillars')->with('success', 'Pillar updated successfully.');
    }

    public function destroy($id)
    {
        $pillar = Pillar::findOrFail($id);
        $pillar->delete();

        return redirect()->route('super_admin.pillars')->with('success', 'Pillar deleted successfully.');
    }
}

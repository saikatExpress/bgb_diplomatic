<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pillar;
use App\Models\SubPillar;
use Illuminate\Http\Request;

class SubpillarController extends Controller
{
    public function index()
    {
        $data['subpillars'] = SubPillar::with('pillar')->get();
        return view('super.partials.subpillars.index', $data);
    }

    public function create()
    {
        $data['pillars'] = Pillar::all();
        return view('super.partials.subpillars.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'pillar_id' => 'required|exists:pillars,id',
        ]);

        $subpillar            = new SubPillar();
        $subpillar->name      = $request->name;
        $subpillar->pillar_id = $request->pillar_id;
        $subpillar->save();

        return redirect()->route('super_admin.subpillars')->with('success', 'Subpillar created successfully.');
    }

    public function edit(SubPillar $subpillar)
    {
        $data['subpillar'] = $subpillar;
        $data['pillars']   = Pillar::all();
        return view('super.partials.subpillars.edit', $data);
    }

    public function update(Request $request, SubPillar $subpillar)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'pillar_id' => 'required|exists:pillars,id',
        ]);

        $subpillar->name      = $request->name;
        $subpillar->pillar_id = $request->pillar_id;
        $subpillar->save();

        return redirect()->route('super_admin.subpillars')->with('success', 'Subpillar updated successfully.');
    }
    public function destroy(SubPillar $subpillar)
    {
        $subpillar->delete();
        return redirect()->route('super_admin.subpillars')->with('success', 'Subpillar deleted successfully.');
    }
}

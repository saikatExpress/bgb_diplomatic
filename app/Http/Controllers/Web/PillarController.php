<?php

namespace App\Http\Controllers\Web;

use App\Models\Pillar;
use App\Models\SubPillar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PillarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pillar_name' => 'required|string|max:255',
            'pillar_description' => 'nullable|string',
        ]);

        $pillar = Pillar::create([
            'name' => $request->pillar_name,
            'description' => 'this is a pillar',
        ]);

        return response()->json([
            'status' => 'success',
            'pillar' => $pillar,
        ]);
    }

    public function subpillarStore(Request $request)
    {
        $request->validate([
            'pillar_id'       => 'required',
            'sub_pillar_name' => 'required|string',
            'type'            => 'required|string',
        ]);

        $subpillar = SubPillar::create([
            'name'      => $request->sub_pillar_name,
            'pillar_id' => $request->pillar_id,
            'type'      => $request->type,
        ]);

        return response()->json([
            'status' => 'success',
            'subpillar' => $subpillar,
        ]);
    }

    public function getSubpillars(Request $request)
    {
        $subpillars = SubPillar::where('pillar_id', $request->query('pillar_id'))->get();

        return response()->json([
            'status' => 'success',
            'subpillars' => $subpillars,
        ]);
    }

}
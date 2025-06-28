<?php

namespace App\Http\Controllers;

use App\Models\LTR;
use App\Models\Tag;
use App\Models\Pillar;
use App\Models\Region;
use App\Models\Incident;
use App\Models\SubPillar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['ltrs'] = LTR::all();
        $data['incidents'] = Incident::all();
        $data['pillars'] = Pillar::all();
        $data['subpillars'] = SubPillar::all();

        $data['tags'] = Tag::all();

        $data['bgbRegions'] = Region::where('country', 'bangladesh')->where('status', 'active')->get();
        $data['bsfRegions'] = Region::where('country', 'india')->where('status', 'active')->get();

        return view('dashboard', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ltr_name' => 'required|string',
        ]);

        $ltr = LTR::create([
            'name' => $request->ltr_name,
            'description' => 'Ltr Subject',
        ]);

        return response()->json([
            'status' => 'success',
            'ltr' => $ltr,
        ]);
    }

    public function incidentStore(Request $request)
    {
        $request->validate([
            'title'                => 'required|string',
            'incident_description' => 'nullable|string',
        ]);

        $incident = Incident::create([
            'title'       => $request->title,
            'description' => $request->incident_description,
        ]);

        return response()->json([
            'status' => 'success',
            'incident' => $incident,
        ]);
    }

    public function actionStore(Request $request)
    {
        return $request->all();
    }
}
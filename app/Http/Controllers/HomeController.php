<?php

namespace App\Http\Controllers;

use App\Models\LTR;
use App\Models\Tag;
use App\Models\Letter;
use App\Models\Pillar;
use App\Models\Region;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $data['ltrs'] = LTR::all();
        $data['incidents'] = Incident::all();
        $data['pillars'] = Pillar::all();

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
        $validator = Validator::make($request->all(), [
            'letter_no'    => 'required',
            'letter_date'  => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $tags = Tag::all();

        $selectedTags = [];
        foreach ($tags as $inputName) {
            if ($request->has($inputName->input_name)) {
                $selectedTags[] = $inputName->input_name;
            }
        }

        $data = [
            'letter_by'        => $request->letter_by,
            'bgb_region_id'    => $request->bgb_region_id,
            'bgb_sec_id'       => $request->bgb_sec_id,
            'bgb_battalion_id' => $request->bgb_battalion_id,
            'bgb_coy_id'       => $request->bgb_coy_id,
            'bgb_bop_id'       => $request->bgb_bop_id,
            'bsf_region_id'    => $request->bsf_region_id,
            'bsf_sec_id'       => $request->bsf_sec_id,
            'bsf_battalion_id' => $request->bsf_battalion_id,
            'bsf_coy_id'       => $request->bsf_coy_id,
            'bsf_bop_id'       => $request->bsf_bop_id,
            'letter_no'        => $request->letter_no,
            'letter_date'      => $request->letter_date,
            'ltr_subject'      => $request->ltr_subject,
            'ltr_incident'     => $request->incident_id,
            'pillar_id'        => $request->pillar_id,
            'subpillar_id'     => $request->subpillar_id,
            'subpillar_type'   => $request->subpillar_type,
            'distance_from'    => $request->distance_from_zero,
            'tags'             => implode(',', $selectedTags),
            'distance_unit'    => $request->distance_unit,
            'killing'          => $request->killing,
            'injuring'         => $request->injuring,
            'beating'          => $request->beating,
            'firing'           => $request->firing,
            'crossing'         => $request->crossing,
        ];

        Letter::create($data);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function mapView()
    {
        return view('web.partials.map.map');
    }

    public function about()
    {
        return view('web.partials.about.about');
    }
}
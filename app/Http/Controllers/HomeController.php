<?php

namespace App\Http\Controllers;

use App\Models\LTR;
use App\Models\Tag;
use App\Models\Letter;
use App\Models\Pillar;
use App\Models\Region;
use App\Models\Incident;
use App\Models\Unit;
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

        $data['units'] = Unit::all();

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
            'ltr_subject' => 'required|string',
            'incident_id'  => 'required|exists:incidents,id',
            'pillar_id'    => 'required|exists:pillars,id',
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
                $selectedTags[] = $request->input($inputName->input_name);
            }
        }

        $letter = Letter::where('letter_no', $request->input('letter_no'))->first();

        if($letter) {
            if($request->has('bgb_region_id')){
                $data['bgb_region_id'] = $request->input('bgb_region_id');
            }
            if($request->has('bgb_sec_id')){
                $data['bgb_sec_id'] = $request->input('bgb_sec_id');
            }
            if($request->has('bgb_battalion_id')){
                $data['bgb_battalion_id'] = $request->input('bgb_battalion_id');
            }
            if($request->has('bgb_coy_id')){
                $data['bgb_coy_id'] = $request->input('bgb_coy_id');
            }
            if($request->has('bgb_bop_id')){
                $data['bgb_bop_id'] = $request->input('bgb_bop_id');
            }
            if($request->has('bsf_region_id')){
                $data['bsf_region_id'] = $request->input('bsf_region_id');
            }
            if($request->has('bsf_sec_id')){
                $data['bsf_sec_id'] = $request->input('bsf_sec_id');
            }
            if($request->has('bsf_battalion_id')){
                $data['bsf_battalion_id'] = $request->input('bsf_battalion_id');
            }
            if($request->has('bsf_coy_id')){
                $data['bsf_coy_id'] = $request->input('bsf_coy_id');
            }
            if($request->has('bsf_bop_id')){
                $data['bsf_bop_id'] = $request->input('bsf_bop_id');
            }

            if($request->has('letter_no')){
                $data['letter_no'] = $request->input('letter_no');
            }
            if($request->has('letter_date')){
                $data['letter_date'] = $request->input('letter_date');
            }
            if($request->has('ltr_subject')){
                $data['ltr_subject'] = $request->input('ltr_subject');
            }
            if($request->has('incident_id')){
                $data['ltr_incident'] = $request->input('incident_id');
            }
            if($request->has('pillar_id')){
                $data['pillar_id'] = $request->input('pillar_id');
            }
            if($request->has('subpillar_id')){
                $data['subpillar_id'] = $request->input('subpillar_id');
            }
            if($request->has('subpillar_type')){
                $data['subpillar_type'] = $request->input('subpillar_type');
            }
            if($request->has('distance_from_zero')){
                $data['distance_from'] = $request->input('distance_from_zero');
            }
            if($request->has('distance_unit')){
                $data['distance_unit'] = $request->input('distance_unit');
            }
            if($request->has('killing')){
                $data['killing'] = $request->input('killing');
            }
            if($request->has('injuring')){
                $data['injuring'] = $request->input('injuring');
            }
            if($request->has('beating')){
                $data['beating'] = $request->input('beating');
            }
            if($request->has('firing')){
                $data['firing'] = $request->input('firing');
            }
            if($request->has('crossing')){
                $data['crossing'] = $request->input('crossing');
            }
            $data['tags'] = json_encode($request->input('tags', []));

            $letter->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Letter updated successfully!'
            ]);
        }

        $data = [
            'letter_by'        => $request->input('letter_by'),
            'bgb_region_id'    => $request->input('bgb_region_id'),
            'bgb_sec_id'       => $request->input('bgb_sec_id'),
            'bgb_battalion_id' => $request->input('bgb_battalion_id'),
            'bgb_coy_id'       => $request->input('bgb_coy_id'),
            'bgb_bop_id'       => $request->input('bgb_bop_id'),
            'bsf_region_id'    => $request->input('bsf_region_id'),
            'bsf_sec_id'       => $request->input('bsf_sec_id'),
            'bsf_battalion_id' => $request->input('bsf_battalion_id'),
            'bsf_coy_id'       => $request->input('bsf_coy_id'),
            'bsf_bop_id'       => $request->input('bsf_bop_id'),
            'letter_no'        => $request->input('letter_no'),
            'letter_date'      => $request->input('letter_date'),
            'ltr_subject'      => $request->input('ltr_subject'),
            'ltr_incident'     => $request->input('incident_id'),
            'pillar_id'        => $request->input('pillar_id'),
            'subpillar_id'     => $request->input('subpillar_id'),
            'subpillar_type'   => $request->input('subpillar_type'),
            'distance_from'    => $request->input('distance_from_zero'),
            'tags'             => json_encode($request->input('tags', [])),
            'distance_unit'    => $request->input('distance_unit'),
            'killing'          => $request->input('killing'),
            'injuring'         => $request->input('injuring'),
            'beating'          => $request->input('beating'),
            'firing'           => $request->input('firing'),
            'crossing'         => $request->input('crossing'),
        ];

        Letter::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Letter created successfully!'
        ]);
    }

    public function mapView()
    {
        $data['regions'] = Region::all();

        $data['pillars'] = Pillar::all();

        $data['incidents'] = Incident::all();

        $letters = Letter::with('pillar:id,lat,lon')->select('letter_no','letter_date', 'pillar_id', 'killing',
        'injuring', 'beating', 'firing', 'crossing')->where('letter_by',
        'BGB')->get();

        $grouped = $letters->groupBy('pillar_id')->map(function ($group) {
            return [
                'pillar_id' => $group->first()->pillar_id,
                'pillar'    => $group->first()->pillar,
                'killing'   => $group->sum('killing'),
                'injuring'  => $group->sum('injuring'),
                'beating'   => $group->sum('beating'),
                'firing'    => $group->sum('firing'),
                'crossing'  => $group->sum('crossing'),
            ];
        })->values();

        $data['infos'] = $grouped;

        return view('web.partials.map.map', $data);
    }

    public function about()
    {
        return view('web.partials.about.about');
    }
}
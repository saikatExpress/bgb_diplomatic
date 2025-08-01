<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Pillar;
use App\Models\Region;
use App\Models\Incident;
use App\Models\LetterFile;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        $data['pillars'] = Pillar::all();

        $data['bgbregions'] = Region::where('country', 'bangladesh')->get();
        $data['bsfregions'] = Region::where('country', 'india')->get();

        $data['incidents'] = Incident::all();

        $data['tags'] = Tag::all();

        $data['units'] = Unit::all();

        return view('web.partials.search.index', $data);
    }

    public function search(Request $request)
    {
        $query = Letter::query();

        if($request->filled('letter_by')) {
            $query->where('letter_by', $request->input('letter_by'));
        }

        if($request->filled('letter_no')) {
            $query->where('letter_no', $request->input('letter_no'));
        }
        if($request->filled('letter_date')) {
            $query->where('letter_date', $request->input('letter_date'));
        }

        if ($request->filled('bgb_region_id')) {
            $query->where('bgb_region_id', $request->input('bgb_region_id'));
        }

        if ($request->filled('bgb_sec_id') && $request->input('bgb_sec_id') !== 'Select Sector') {
            $query->where('bgb_sec_id', $request->input('bgb_sec_id'));
        }

        if ($request->filled('bgb_battalion_id') && $request->input('bgb_battalion_id') !== 'Select Battalion') {
            $query->where('bgb_battalion_id', $request->input('bgb_battalion_id'));
        }

        if ($request->filled('bgb_coy_id') && $request->input('bgb_coy_id') !== 'Select Company') {
            $query->where('bgb_coy_id', $request->input('bgb_coy_id'));
        }

        if ($request->filled('bgb_bop_id') && $request->input('bgb_bop_id') !== 'Select BOP') {
            $query->where('bgb_bop_id', $request->input('bgb_bop_id'));
        }

        if ($request->filled('bsf_region_id') && $request->input('bsf_region_id') !== 'Select Frontier') {
            $query->where('bsf_region_id', $request->input('bsf_region_id'));
        }

        if ($request->filled('bsf_sec_id') && $request->input('bsf_sec_id') !== 'Select Sector') {
            $query->where('bsf_sec_id', $request->input('bsf_sec_id'));
        }

        if ($request->filled('bsf_battalion_id') && $request->input('bsf_battalion_id') !== 'Select Battalion') {
            $query->where('bsf_battalion_id', $request->input('bsf_battalion_id'));
        }

        if ($request->filled('bsf_coy_id') && $request->input('bsf_coy_id') !== 'Select Company') {
            $query->where('bsf_coy_id', $request->input('bsf_coy_id'));
        }

        if ($request->filled('bsf_bop_id') && $request->input('bsf_bop_id') !== 'Select BOP') {
            $query->where('bsf_bop_id', $request->input('bsf_bop_id'));
        }

        if ($request->filled('pillar_no') && $request->input('pillar_no') !== 'Select Piller') {
            $query->where('pillar_id', $request->input('pillar_no'));
        }

        if ($request->filled('sub_pillar_no') && $request->input('sub_pillar_no') !== 'Select Sub Piller') {
            $query->where('subpillar_id', $request->input('sub_pillar_no'));
        }

        if ($request->filled('distance_from_zero')) {
            $query->where('distance_from_zero', $request->input('distance_from_zero'));
        }

        if ($request->filled('ltr_incident')) {
            $query->where('ltr_incident', $request->input('ltr_incident'));
        }

        if ($request->filled('distance_unit')) {
            $query->where('distance_unit', $request->input('distance_unit'));
        }

        if ($request->filled('killing')) {
            $query->where('killing', $request->input('killing'));
        }
        if ($request->filled('injuring')) {
            $query->where('injuring', $request->input('injuring'));
        }
        if ($request->filled('beating')) {
            $query->where('beating', $request->input('beating'));
        }
        if ($request->filled('firing')) {
            $query->where('firing', $request->input('firing'));
        }

        if ($request->filled('crossing')) {
            $query->where('crossing', $request->input('crossing'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('tags')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->input('tags') as $tag) {
                    $q->whereJsonContains('tags', $tag);
                }
            });
        }

        if ($request->filled('from_date')) {
            $query->whereDate('letter_date', '>=', $request->input('from_date'));
        }

        if ($request->filled('to_date')) {
            $query->whereDate('letter_date', '<=', $request->input('to_date'));
        }

        $results = $query->orderBy('letter_date', 'desc')->get();

        $letterNos = $results->pluck('letter_no');

        $files = LetterFile::whereIn('letter_number', $letterNos)->get();

        $files = $files->map(function ($file) use ($results) {
            $relatedLetter = $results->firstWhere('letter_no', $file->letter_number);

            if ($relatedLetter) {
                if($file->letter_by == 'BGB'){
                    $file->bgb_region_name = $relatedLetter->bgb_region->name ?? '';
                    $file->bgb_sector_name = $relatedLetter->bgb_sector->name ?? '';
                    $file->bgb_battalion_name = $relatedLetter->bgb_battalion->name ?? '';
                    $file->bgb_coy_name = $relatedLetter->bgb_company->name ?? '';
                    $file->bgb_bop_name = $relatedLetter->bgb_bop->name ?? '';
                }else{
                    $file->bsf_region_name = $relatedLetter->bsf_region->name ?? '';
                    $file->bsf_sector_name = $relatedLetter->bsf_sector->name ?? '';
                    $file->bsf_battalion_name = $relatedLetter->bsf_battalion->name ?? '';
                    $file->bsf_coy_name = $relatedLetter->bsf_company->name ?? '';
                    $file->bsf_bop_name = $relatedLetter->bsf_bop->name ?? '';
                }

                $file->pillar_name = $relatedLetter->pillar->name ?? '';
                $file->incident_name = $relatedLetter->incident_name;
                $file->ltr_date = $relatedLetter->letter_date;
            }

            return $file;
        });

        $mainFile      = $files->where('file_prefix', 'main')->groupBy('letter_number')->count();
        $referenceFile = $files->where('file_prefix', 'ref')->groupBy('letter_number')->count();
        $replyFile     = $results->where('status', 'replied')->count();
        $noReplyFile   = $results->where('status', 'no_reply')->count();

        return response()->json([
            'status'      => 'success',
            'results'     => $results,
            'main'        => $mainFile,
            'reference'   => $referenceFile,
            'replyFile'   => $replyFile,
            'noreplyFile' => $noReplyFile,
            'files'       => $files
        ]);
    }

    public function store(Request $request)
    {
        $query = Letter::query();

        if($request->filled('region_id')){
            $query->where('bgb_region_id', $request->region_id);
        }

        if($request->filled('sector_id')){
            $query->where('bgb_sec_id', $request->sector_id);
        }

        if($request->filled('battalion_id')){
            $query->where('bgb_battalion_id', $request->battalion_id);
        }

        if($request->filled('company_id')){
            $query->where('bgb_coy_id', $request->company_id);
        }

        if($request->filled('bop_id')){
            $query->where('bgb_bop_id', $request->bop_id);
        }

        $letters = $query->with('pillar:id,lat,lon')->where('letter_by',
        'BGB')->select('letter_no','letter_date','pillar_id', 'killing',
        'injuring', 'beating', 'firing', 'crossing')->get();

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

        $infos = $grouped;

        return response()->json([
            'infos' => $infos
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Pillar;
use App\Models\Region;
use App\Models\Incident;
use App\Models\LetterFile;
use App\Models\Tag;
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

        return view('web.partials.search.index', $data);
    }

    public function search(Request $request)
    {
        $query = Letter::query();

        if($request->filled('letter_by')) {
            $query->where('letter_by', $request->letter_by);
        }

        if($request->filled('letter_no')) {
            $query->where('letter_no', $request->letter_no);
        }
        if($request->filled('letter_date')) {
            $query->where('letter_date', $request->letter_date);
        }

        if ($request->filled('bgb_region_id')) {
            $query->where('bgb_region_id', $request->bgb_region_id);
        }

        if ($request->filled('bgb_battalion_id') && $request->bgb_battalion_id !== 'Select Battalion') {
            $query->where('bgb_battalion_id', $request->bgb_battalion_id);
        }

        if ($request->filled('bgb_coy_id') && $request->bgb_coy_id !== 'Select Company') {
            $query->where('bgb_coy_id', $request->bgb_coy_id);
        }

        if ($request->filled('bgb_bop_id') && $request->bgb_bop_id !== 'Select BOP') {
            $query->where('bgb_bop_id', $request->bgb_bop_id);
        }

        if ($request->filled('bsf_region_id') && $request->bsf_region_id !== 'Select Frontier') {
            $query->where('bsf_region_id', $request->bsf_region_id);
        }

        if ($request->filled('bsf_sec_id') && $request->bsf_sec_id !== 'Select Sector') {
            $query->where('bsf_sec_id', $request->bsf_sec_id);
        }

        if ($request->filled('bsf_battalion_id') && $request->bsf_battalion_id !== 'Select Battalion') {
            $query->where('bsf_battalion_id', $request->bsf_battalion_id);
        }

        if ($request->filled('bsf_coy_id') && $request->bsf_coy_id !== 'Select Company') {
            $query->where('bsf_coy_id', $request->bsf_coy_id);
        }

        if ($request->filled('bsf_bop_id') && $request->bsf_bop_id !== 'Select BOP') {
            $query->where('bsf_bop_id', $request->bsf_bop_id);
        }

        if ($request->filled('pillar_no') && $request->pillar_no !== 'Select Piller') {
            $query->where('pillar_id', $request->pillar_no);
        }

        if ($request->filled('sub_pillar_no') && $request->sub_pillar_no !== 'Select Sub Piller') {
            $query->where('subpillar_id', $request->sub_pillar_no);
        }

        if ($request->filled('distance_from_zero')) {
            $query->where('distance_from_zero', $request->distance_from_zero);
        }
        if ($request->filled('distance_unit')) {
            $query->where('distance_unit', $request->distance_unit);
        }

        if ($request->filled('killing')) {
            $query->where('killing', $request->killing);
        }
        if ($request->filled('injuring')) {
            $query->where('injuring', $request->injuring);
        }
        if ($request->filled('beating')) {
            $query->where('beating', $request->beating);
        }
        if ($request->filled('firing')) {
            $query->where('firing', $request->firing);
        }

        if ($request->filled('crossing')) {
            $query->where('crossing', $request->crossing);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $results = $query->orderBy('created_at', 'desc')->get();

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

        $mainFile = $files->where('file_prefix', 'main')->count();
        $referenceFile = $files->where('file_prefix', 'ref')->count();
        $replyFile = $files->where('file_prefix', 'reply-file')->count();
        $noReplyFile = $results->where('status', 'no_reply')->count();

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
}
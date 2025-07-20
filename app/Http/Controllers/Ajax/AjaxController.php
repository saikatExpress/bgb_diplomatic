<?php

namespace App\Http\Controllers\Ajax;

use Imagick;
use App\Models\BOP;
use App\Models\Sector;
use App\Models\Company;
use setasign\Fpdi\Fpdi;
use App\Models\Battalion;
use App\Models\LetterFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{
    public function getSectorsByRegion(Request $request)
    {
        $regionId = $request->input('region_id');

        // Assuming you have a model Sector and a method to fetch sectors by region
        $sectors = Sector::where('region_id', $regionId)->get();

        return response()->json($sectors);
    }

    public function getBattalionsBySector(Request $request)
    {
        $sectorId = $request->input('sector_id');

        $battalions = Battalion::where('sector_id', $sectorId)->get();

        return response()->json($battalions);
    }

    public function getCompaniesByBattalion(Request $request)
    {
        $battalionId = $request->input('battalion_id');

        // Assuming you have a model Company and a method to fetch companies by battalion
        $companies = Company::where('battalion_id', $battalionId)->get();

        return response()->json($companies);
    }

    public function getBopsByCompany(Request $request)
    {
        $companyId = $request->input('company_id');

        // Assuming you have a model Bop and a method to fetch BOPs by company
        $bops = BOP::where('company_id', $companyId)->get();

        return response()->json($bops);
    }

    public function fetchedLetter(Request $request)
    {
        $letterNo = $request->get('letterNo');
        $letterBy = $request->get('letterBy');

        $letters = LetterFile::where('letter_number', $letterNo)->get();

        $letter = Letter::where('letter_no', $letterNo)->first();

        return response()->json([
            'status'   => $letter ? 'success' : 'not_found',
            'letters'  => $letters,
            'letter'   => $letter,
            'letterBy' => $letterBy
        ]);
    }

    public function deleteFile($id)
    {
        $file = LetterFile::find($id);
        if($file){

            $letterNo = $file->letter_number;

            $letter = Letter::where('letter_no', $letterNo)->first();

            if($file->file_prefix == 'reply-file'){
                $letter->update(['status' => 'no_reply']);
            }

            if($file->file_prefix == 'main'){
                $letter->delete();
            }

            $storagePath = str_replace('/storage/', 'public/', $file->file_path);

            if (Storage::exists($storagePath)) {
                Storage::delete($storagePath);
            }

            $file->delete();

            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);
        }
    }
}

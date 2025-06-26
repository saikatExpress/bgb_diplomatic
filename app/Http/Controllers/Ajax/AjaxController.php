<?php

namespace App\Http\Controllers\Ajax;

use App\Models\BOP;
use App\Models\Sector;
use App\Models\Battalion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

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

        // Assuming you have a model Battalion and a method to fetch battalions by sector
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
}
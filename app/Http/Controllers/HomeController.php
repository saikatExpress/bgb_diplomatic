<?php

namespace App\Http\Controllers;

use App\Models\LTR;
use App\Models\Incident;
use App\Models\Pillar;
use App\Models\Region;
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

        $data['bgbRegions'] = Region::where('country', 'bangladesh')->where('status', 'active')->get();
        $data['bsfRegions'] = Region::where('country', 'india')->where('status', 'active')->get();

        return view('dashboard', $data);
    }
}

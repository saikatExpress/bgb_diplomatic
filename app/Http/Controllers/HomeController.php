<?php

namespace App\Http\Controllers;

use App\Models\LTR;
use App\Models\Incident;
use App\Models\Pillar;
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

        return view('dashboard', $data);
    }
}

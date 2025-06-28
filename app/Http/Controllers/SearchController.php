<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Pillar;
use App\Models\Region;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $data['pillars'] = Pillar::all();

        $data['bgbregions'] = Region::where('country', 'bangladesh')->get();
        $data['bsfregions'] = Region::where('country', 'india')->get();

        $data['incidents'] = Incident::all();

        return view('web.partials.search.index', $data);
    }

    public function search(Request $request)
    {
        return $request->all();
    }
}
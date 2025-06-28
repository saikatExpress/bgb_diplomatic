<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $data['pillars'] = Pillar::all();

        return view('web.partials.search.index', $data);
    }
}
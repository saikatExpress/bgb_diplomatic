<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['bgbInfo'] = Letter::where('letter_by', 'BGB')
        ->selectRaw('SUM(killing) as totalKilling, SUM(injuring) as totalinjuring, SUM(beating) as
        totalbeating, SUM(firing) as totalfiring, SUM(crossing) as totalcrossing')->first();

        $data['bsfInfo'] = Letter::where('letter_by', 'BSF')
        ->selectRaw('SUM(killing) as totalKilling, SUM(injuring) as totalinjuring, SUM(beating) as
        totalbeating, SUM(firing) as totalfiring, SUM(crossing) as totalcrossing')->first();

        return view('admin.dashboard', $data);
    }
}

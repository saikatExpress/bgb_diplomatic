<?php

namespace App\Http\Controllers\Web;

use App\Models\Pillar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PillarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pillar_name' => 'required|string|max:255',
            'pillar_description' => 'nullable|string',
        ]);

        $pillar = Pillar::create([
            'name' => $request->pillar_name,
            'description' => 'this is a pillar',
        ]);

        return response()->json([
            'status' => 'success',
            'pillar' => $pillar,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Super;

use Carbon\Carbon;
use App\Models\Unit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index()
    {
        $data['units'] = Unit::all();
        return view('setting.partials.unit.index', $data);
    }

    public function create()
    {
        return view('setting.partials.unit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $unit = Unit::create([
            'name'       => Str::title($request->input('name')),
            'slug'       => Str::slug($request->input('name'), '-'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Unit created successfully',
            'data'    => $unit
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $unit = Unit::find($id);

        $unit->update([
            'name'       => Str::title($request->input('name')),
            'slug'       => Str::slug($request->input('name'), '-'),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Unit updated successfully',
            'data'    => $unit
        ]);
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Unit deleted successfully',
            'data'    => $unit,
        ]);
    }
}

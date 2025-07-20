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
        return view('super.partials.unit.index', $data);
    }

    public function create()
    {
        return view('super.partials.unit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Unit::create([
            'name'       => Str::title($request->input('name')),
            'slug'       => Str::slug($request->input('name'), '-'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('unit.index')->with('success', 'Unit created successfully.');
    }

    public function edit(Unit $unit)
    {
        return view('super.partials.unit.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $unit->update([
            'name'       => Str::title($request->input('name')),
            'slug'       => Str::slug($request->input('name'), '-'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('unit.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('unit.index')->with('success', 'Unit deleted successfully.');
    }
}

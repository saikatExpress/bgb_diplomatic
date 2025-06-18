<?php

namespace App\Http\Controllers;

use App\Http\Requests\LTRStoreRequest;
use App\Http\Requests\LTRUpdateRequest;
use App\Models\LTR;
use Illuminate\Http\Request;

class LTRController extends Controller
{
    public function index()
    {
        $data['ltrs'] = LTR::latest()->get();
        return view('super.partials.ltr.index', $data);
    }

    public function create()
    {
        $data['ltrs'] = LTR::latest()->take(10)->get();

        return view('super.partials.ltr.create', $data);
    }

    public function store(LTRStoreRequest $request)
    {
        LTR::create($request->validated());
        return redirect()->route('super_admin.ltr.create')->with('success', 'LTR created successfully.');
    }

    public function edit($id)
    {
        $ltr = LTR::findOrFail($id);
        return view('super.partials.ltr.edit', compact('ltr'));
    }

    public function update(LTRUpdateRequest $request, $id)
    {
        $ltr = LTR::findOrFail($id);
        $ltr->update($request->validated());
        return redirect()->route('super_admin.ltr')->with('success', 'LTR updated successfully.');
    }

    public function destroy($id)
    {
        $ltr = LTR::findOrFail($id);
        $ltr->delete();
        return redirect()->route('super_admin.ltr')->with('success', 'LTR deleted successfully.');
    }
}

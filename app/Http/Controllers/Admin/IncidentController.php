<?php

namespace App\Http\Controllers\Admin;

use App\Models\Incident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;

class IncidentController extends Controller
{
    public function index()
    {
        $data['incidents'] = Incident::latest()->get();
        return view('super.partials.incidents.index', $data);
    }

    public function create()
    {
        $data['incidents'] = Incident::latest()->take(10)->get();
        return view('super.partials.incidents.create', $data);
    }

    public function store(IncidentRequest $request)
    {
        Incident::store($request);
        return redirect()->route('super_admin.incidents.create')->with('success', 'Incident created successfully.');
    }

    public function edit($id)
    {
        $data['incident'] = Incident::findOrFail($id);
        if (!$data['incident']) {
            return redirect()->route('super_admin.incidents')->with('error', 'Incident not found.');
        }
        return view('super.partials.incidents.edit', $data);
    }

    public function update(UpdateIncidentRequest $request, $id)
    {
        Incident::updateIncident($request, $id);
        return redirect()->route('super_admin.incidents')->with('success', 'Incident updated successfully.');
    }

    public function destroy($id)
    {
        $incident = Incident::findOrFail($id);
        if (!$incident) {
            return redirect()->route('super_admin.incidents')->with('error', 'Incident not found.');
        }
        $incident->delete();

        return redirect()->route('super_admin.incidents')->with('success', 'Incident deleted successfully.');
    }
}

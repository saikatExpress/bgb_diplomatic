<?php

namespace App\Http\Controllers\Admin;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentRequest;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UpdateIncidentRequest;

class IncidentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Incident::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function($data){
                    return filter($data->description);
                })
                ->addColumn('status', function($data){
                    $status = filter($data->status);

                    if($status == 'Active'){
                        return '<button class="btn btn-sm btn-success">' . $status .'</button>';
                    }else{
                        return '<button class="btn btn-sm btn-danger">' . $status .'</button>';
                    }
                })

                ->addColumn('action', function ($data) {
                    $editRoute = route('incident.edit', ['incident' => $data->id]);
                    $deleteRoute = route('incident.destroy', ['incident' => $data->id]);
                    $actionButtons = '
                        <a href="' . $editRoute . '" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-danger"
                            onclick="showDeleteConfirm(' . $data->id . ', \'' . $deleteRoute . '\')">
                            <i class="fa-solid fa-trash"></i>
                        </button>';
                    return $actionButtons;
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('setting.partials.incident.index');
    }

    public function create()
    {
        return view('setting.partials.incident.create');
    }

    public function store(IncidentRequest $request): JsonResponse
    {
        return Incident::store($request->validated());
    }

    public function edit(Incident $incident)
    {
        return view('setting.partials.incident.edit', compact('incident'));
    }

    public function update(UpdateIncidentRequest $request, Incident $incident): JsonResponse
    {
        return Incident::updateIncident($request->validated(), $incident);
    }

    public function destroy(Incident $incident): JsonResponse
    {
        $incident->delete();

        return response()->json(['success' => true]);
    }
}

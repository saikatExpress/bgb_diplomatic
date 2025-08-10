<?php

namespace App\Http\Controllers\Web;

use App\Models\Pillar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePillarRequest;
use App\Http\Requests\UpdatePillarRequest;

class PillarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pillar::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function($data){
                    return filter($data->description);
                })

                ->addColumn('action', function ($data) {
                    $editRoute = route('pillar.edit', ['pillar' => $data->id]);
                    $deleteRoute = route('pillar.destroy', ['pillar' => $data->id]);
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

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('setting.partials.pillar.index');
    }

    public function create()
    {
        return view('setting.partials.pillar.create');
    }

    public function store(StorePillarRequest $request): JsonResponse
    {
        return Pillar::store($request->validated());
    }

    public function edit(Pillar $pillar)
    {
        return view('setting.partials.pillar.edit', compact('pillar'));
    }

    public function update(UpdatePillarRequest $request, Pillar $pillar)
    {
        return Pillar::updateData($request->validated(), $pillar);
    }

    public function destroy(Pillar $pillar)
    {
        $pillar->delete();

        return response()->json(['success' => true]);
    }
}
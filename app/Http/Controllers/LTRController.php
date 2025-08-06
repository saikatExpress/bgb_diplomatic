<?php

namespace App\Http\Controllers;

use App\Models\LTR;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LTRStoreRequest;
use App\Http\Requests\LTRUpdateRequest;

class LTRController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LTR::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function($data){
                    return filter($data->description);
                })

                ->addColumn('action', function ($data) {
                    $editRoute = route('ltr.edit', ['ltr' => $data->id]);
                    $deleteRoute = route('ltr.destroy', ['ltr' => $data->id]);
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
        return view('setting.partials.ltr.index');
    }

    public function create()
    {
        return view('setting.partials.ltr.create');
    }

    public function store(LTRStoreRequest $request): JsonResponse
    {
        return LTR::store($request->validated());
    }

    public function edit(LTR $ltr)
    {
        return view('setting.partials.ltr.edit', compact('ltr'));
    }

    public function update(LTRUpdateRequest $request, LTR $ltr): JsonResponse
    {
        return LTR::updateData($request->validated(), $ltr);
    }

    public function destroy(LTR $ltr): JsonResponse
    {
        $ltr->delete();
        return response()->json(['success' => true]);
    }
}

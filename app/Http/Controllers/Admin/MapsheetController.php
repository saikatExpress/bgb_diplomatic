<?php

namespace App\Http\Controllers\Admin;

use App\Models\MapSheet;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMapsheetRequest;
use App\Http\Requests\UpdateMapSheetRequest;

class MapsheetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MapSheet::latest();

            if ($request->title) {
                $query->where('title', 'like', '%' . $request->title . '%');
            }

            return datatables()->of($query)
                ->addIndexColumn()

                ->addColumn('updated_at', function($row){
                    $date = formatDate($row->updated_at, 'custom');
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('mapsheet.edit', $row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="'.route('mapsheet.destroy', $row->id).'" method="POST" class="d-inline"
                            onsubmit="return confirm(\'Are you sure?\')">
                            '.csrf_field().method_field('DELETE').'
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('setting.partials.mapsheet.index');
    }

    public function create()
    {
        return view('setting.partials.mapsheet.create');
    }

    public function store(StoreMapsheetRequest $request): JsonResponse
    {
        return MapSheet::store($request->validated());
    }

    public function edit(MapSheet $mapsheet)
    {
        return view('setting.partials.mapsheet.edit', compact('mapsheet'));
    }

    public function update(UpdateMapSheetRequest $request, MapSheet $mapsheet)
    {
        return MapSheet::updateData($request->validated(), $mapsheet);
    }

    public function destroy(MapSheet $mapsheet)
    {
        $mapsheet->delete();

        return redirect()->back()->with('success', 'Mapsheet Deleted successfully');
    }
}
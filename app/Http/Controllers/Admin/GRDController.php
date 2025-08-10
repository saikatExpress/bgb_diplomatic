<?php

namespace App\Http\Controllers\Admin;

use App\Models\GRD;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrdRequest;
use App\Http\Requests\UpdateGrdRequest;

class GRDController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = GRD::latest();

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
                        <a href="'.route('grd.edit', $row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="'.route('grd.destroy', $row->id).'" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure?\')">
                            '.csrf_field().method_field('DELETE').'
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('setting.partials.grd.index');
    }

    public function create()
    {
        return view('setting.partials.grd.create');
    }

    public function store(StoreGrdRequest $request)
    {
        return GRD::store($request->validated());
    }

    public function edit(GRD $grd)
    {
        return view('setting.partials.grd.edit', compact('grd'));
    }

    public function update(UpdateGrdRequest $request, GRD $grd)
    {
        return GRD::updateData($request->validated(), $grd);
    }

    public function destroy(GRD $grd)
    {
        $grd->delete();

        return redirect()->back()->with('success', 'GRD deleted successfully');
    }
}
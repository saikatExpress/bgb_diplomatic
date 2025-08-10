<?php

namespace App\Http\Controllers\Admin;

use App\Models\GR;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrRequest;
use App\Http\Requests\UpdateGrRequest;

class GRController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = GR::latest();

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
                        <a href="'.route('gr.edit', $row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="'.route('gr.destroy', $row->id).'" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure?\')">
                            '.csrf_field().method_field('DELETE').'
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('setting.partials.gr.index');
    }

    public function create()
    {
        return view('setting.partials.gr.create');
    }
    public function store(StoreGrRequest $request)
    {
        return GR::store($request->validated());
    }

    public function edit(GR $gr)
    {
        return view('setting.partials.gr.edit', compact('gr'));
    }

    public function update(UpdateGrRequest $request, GR $gr)
    {
        return GR::updateData($request->validated(), $gr);
    }

    public function destroy(GR $gr)
    {
        $gr->delete();

        return redirect()->back()->with('success', 'GR Deleted successfully');
    }
}
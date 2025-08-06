<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBattalionRequest;
use App\Http\Requests\updateBattalionRequest;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Battalion;

class BattalionController extends Controller
{
    public function index(Request $request)
    {
        $data['sectors'] = Sector::all();

        if ($request->ajax()) {
            $query = Battalion::with('sector');

            if ($request->sector_id) {
                $query->where('sector_id', $request->sector_id);
            }

            if ($request->name) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('sector_name', fn($row) => $row->sector->name ? $row->sector->name : '-')

                ->addColumn('updated_at', function($row){
                    $date = formatDate($row->created_at, 'custom');
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('battalion.edit', $row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="'.route('battalion.destroy', $row->id).'" method="POST" class="d-inline"
                            onsubmit="return confirm(\'Are you sure?\')">
                            '.csrf_field().method_field('DELETE').'
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('setting.partials.battalion.index', $data);
    }

    public function create()
    {
        $data['sectors'] = Sector::all();

        return view('setting.partials.battalion.create', $data);
    }

    public function store(StoreBattalionRequest $request)
    {
        return Battalion::store($request->validated());
    }

    public function edit(Battalion $battalion)
    {
        $data['battalion'] = $battalion;
        $data['sectors'] = Sector::with('region')->get();

        return view('setting.partials.battalion.edit', $data);
    }

    public function update(updateBattalionRequest $request, Battalion $battalion)
    {
        return Battalion::updateBattalion($request->validated(), $battalion);
    }

    public function destroy(Battalion $battalion)
    {
        $battalion->delete();
        return redirect()->route('battalion.index')->with('success', 'Battalion successfully deleted');
    }
}

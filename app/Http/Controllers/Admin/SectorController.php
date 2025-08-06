<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectorRequest;
use App\Http\Requests\UpdateSectorRequest;

class SectorController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::all();

        if ($request->ajax()) {
            $query = Sector::with('region');

            if ($request->region_id) {
                $query->where('region_id', $request->region_id);
            }

            if ($request->name) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('region_name', fn($row) => $row->region->name ? $row->region->name : '-')
                ->addColumn('status', function($row){
                    $class = $row->status == 'active' ? 'btn-success' : 'btn-danger';
                    $text = filter($row->status);
                    return '<button data-id="'.$row->id.'" class="btn btn-sm '.$class.' btnToggleStatus">'.$text.'</button>';
                })
                ->addColumn('updated_at', function($row){
                    $date = formatDate($row->created_at, 'custom');
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('sector.edit', $row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="'.route('sector.destroy', $row->id).'" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure?\')">
                            '.csrf_field().method_field('DELETE').'
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }

        return view('setting.partials.sector.index', compact('regions'));
    }
    public function create()
    {
        $data['regions'] = Region::all();

        return view('setting.partials.sector.create', $data);
    }
    public function store(StoreSectorRequest $request)
    {
        return Sector::store($request->validated());
    }
    public function edit(Sector $sector)
    {
        $data['sector'] = $sector;
        $data['regions'] = Region::all();

        return view('setting.partials.sector.edit', $data);
    }
    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        return Sector::updateSector($request->validated(), $sector);
    }

    public function destroy(Sector $sector)
    {
        $sector->delete();

        return redirect()->route('sector.index')->with('success', 'Sector deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();

        if ($request->ajax()) {
            $query = Tag::latest();

            if ($request->title) {
                $query->where('title', 'like', '%' . $request->title . '%');
            }

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('title', fn($row) => filter($row->title))
                ->addColumn('updated_at', function($row){
                    $date = formatDate($row->updated_atat, 'custom');
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('tag.edit', $row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="'.route('tag.destroy', $row->id).'" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure?\')">
                            '.csrf_field().method_field('DELETE').'
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('setting.partials.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('setting.partials.tag.create');
    }

    public function store(StoreTagRequest $request)
    {
        return Tag::store($request->validated());
    }

    public function edit(Tag $tag)
    {
        return view('setting.partials.tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        return Tag::updateTag($tag, $request->validated());
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->back()->with('success', 'Tag successfully deleted');
    }
}
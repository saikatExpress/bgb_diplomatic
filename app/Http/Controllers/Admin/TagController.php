<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $data['tags'] = Tag::all();
        return view('super.partials.tags.index', $data);
    }

    public function create()
    {
        // Logic to show the form for creating a new tag
        return view('super.partials.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        return Tag::store($request->validated());
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('super.partials.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, $id)
    {
        return Tag::updateTag($id, $request->validated());
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('super_admin.tags')->with('success', 'Tag deleted successfully.');
    }
}
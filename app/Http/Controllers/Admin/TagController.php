<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        // Logic to display all tags
        return view('super.partials.tags.index');
    }

    public function create()
    {
        // Logic to show the form for creating a new tag
        return view('super.partials.tags.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new tag
        // Validate and save the tag
        return redirect()->route('super_admin.tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit($id)
    {
        // Logic to show the form for editing an existing tag
        return view('super.partials.tags.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing tag
        // Validate and update the tag
        return redirect()->route('super_admin.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete a tag
        return redirect()->route('super_admin.tags.index')->with('success', 'Tag deleted successfully.');
    }
}
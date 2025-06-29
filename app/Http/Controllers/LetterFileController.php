<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LetterFileController extends Controller
{
    public function upload(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf|max:10240',
            'letter_number' => 'required|string|max:255',
        ]);

        // Store file in storage/app/public/letter_files
        $path = $request->file('file')->store('public/letter_files');



        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully.',
            'file_path' => Storage::url($path),
        ]);
    }
}
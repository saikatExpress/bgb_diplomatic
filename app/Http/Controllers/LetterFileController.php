<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Carbon\Carbon;
use App\Models\LetterFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LetterFileController extends Controller
{
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file_type'     => ['required', 'string', 'max:255'],
            'file'          => ['required','file','mimes:pdf','max:10240'],
            'letter_number' => ['required','string','max:255'],
            'file_prefix'   => ['required','string','max:255'],
        ]);

        $file = $request->file('file');

        $datePart   = Carbon::now()->format('Y-m-d');
        $letterPart = Str::slug($validated['letter_number']);
        $prefixPart = Str::slug($validated['file_prefix']);

        $filename = "{$datePart}_{$letterPart}_{$prefixPart}.pdf";

        // Store file
        $path = $file->storeAs('public/letter_files', $filename);

        // Build data for DB
        $data = [
            'letter_by'     => $validated['file_type'],
            'letter_number' => $validated['letter_number'],
            'file_prefix'   => $prefixPart,
            'file_path'     => Storage::url($path),
        ];

        $file = LetterFile::create($data);

        if($validated['file_prefix'] == 'reply_file'){
            Letter::where('letter_no', $validated['letter_number'])->update(['status' => 'replied']);
        }

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully.',
            'data'    => $data,
            'last_id' => $file->id
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'last_id'       => 'required|integer|exists:letter_files,id',
            'file_type'     => 'required|string',
            'letter_number' => 'required|string',
        ]);

        $letterNumber = $request->letter_number;

        $fileInfo = LetterFile::where('id', $request->last_id)->where('letter_number', $letterNumber)->first();

        if (!$fileInfo) {
            return response()->json([
                'success' => false,
                'message' => 'No matching files found.'
            ]);
        }

        $storagePath = str_replace('/storage/', 'public/', $fileInfo->file_path);

        if (Storage::exists($storagePath)) {
            Storage::delete($storagePath);
        }

        $fileInfo->delete();

        return response()->json([
            'success' => true,
            'message' => 'All files and metadata deleted successfully.'
        ]);
    }
}
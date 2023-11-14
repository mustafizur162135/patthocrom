<?php

namespace App\Http\Controllers\Backend\note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();

        return view('Backend.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('backend.notes.form');
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);

        return view('backend.notes.form', compact('note'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();

        // Manually create the 'uploads' directory if it doesn't exist
        $directory = 'uploads';
        Storage::disk('public')->makeDirectory($directory);

        // Store the file in the 'uploads' directory
        $filePath = $file->storeAs($directory, $fileName, 'public');
        Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('notes.index')->with('success', 'Note uploaded successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'sometimes|mimes:pdf|max:2048', // Allow updating the file, but with validation
        ]);

        $note = Note::findOrFail($id);

        // Update title and description
        $note->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Update file if provided
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::delete($note->file_path);

            // Store new file
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $note->update([
                'file_path' => $filePath,
            ]);
        }

        return redirect()->route('notes.index')->with('success', 'Note updated successfully');
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        // Delete associated PDF file
        Storage::delete($note->file_path);

        // Delete the note
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted successfully');
    }
}

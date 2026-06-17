<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{

    // !!!!! Show All notes.
    public function index()
    {

        $sessionId = Auth::user()->id;

        $notes = Note::select('*')
            ->where('user_id', $sessionId)
            ->get();

        return view('notes.index', [
            'notes' => $notes
        ]);
    }

    // !!!!! Create Note.
    public function create()
    {
        return view('notes.create');
    }

    // !!!!! Store Note.
    public function store(NoteRequest $request)
    {
        $sessionId = Auth::user()->id;

        Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $sessionId
        ]);

        return redirect('/notes')->with('success', 'Note created successfully');
    }

    // !!!!! Show Note.
    public function show(int $id)
    {
        $note = Note::findOrfail($id);

        return view('notes.show', [
            'note' => $note
        ]);
    }

    // !!!!! Edit Note.
    public function edit(int $id)
    {
        $note = Note::findOrfail($id);

        return view('notes.edit', ['note' => $note]);
    }



    // !!!!! Update Note.
    public function update(NoteRequest $request, int $id)
    {

        // 1- Get The Not Record By id.
        $note = Note::findOrFail($id);

        // 3- update the data of not after validation.
        $note->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // 4- Redirect to Show Note Data.
        return redirect('notes/' . $request->id)->with('success', 'Note updated successfully');
    }


    // !!!!! Delete Note.
    public function destroy(int $id)
    {
        $note = Note::findOrFail($id);

        $note->delete();

        return redirect('/notes')->with('success', 'Note deleted successfully');
    }


    // --------- End Controller ---------
}

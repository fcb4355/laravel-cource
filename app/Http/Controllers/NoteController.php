<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    // !!!!! Show All notes.
    public function index()
    {
        return view('notes.index', [
            'notes' => Auth::User()->notes
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

        Auth::User()->notes()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
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

        Auth::User()->notes()->update([
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

        $note = Auth::User()->notes()->findOrFail($id);

        $note->delete();

        return redirect('/notes')->with('success', 'Note deleted successfully');
    }


    // --------- End Controller ---------
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;

class DestroyNotesController extends Controller
{
    /**
     * Delete All notes.
     */
    public function __invoke()
    {
        $note = Note::all();

        if ($note->count() === 0) {
            return redirect('/notes')->with('error', 'There are no notes to delete.');
        }

        Note::query()->delete();

        return redirect('/notes')
            ->with('success', 'All notes deleted successfully')
            ->with('warning', 'No have any notes.');
    }
}

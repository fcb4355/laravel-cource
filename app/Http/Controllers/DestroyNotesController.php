<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class DestroyNotesController extends Controller
{
    /**
     * Delete All notes.
     */
    public function __invoke()
    {

        $deletedNotes = Auth::User()->notes()->delete();

        if ($deletedNotes === 0) {
            return redirect('/notes')
                ->with('error', 'There are no notes to delete.');
        } else {
            return redirect('/notes')
                ->with('success', 'All notes deleted successfully');
        }
    }
}

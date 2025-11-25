<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create()
    {
        return view('note.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'string|required|min:10',
            'bill_id' => 'required'
        ]);

        Note::create([
            'message' => $request->message,
            'bill_id' => $request->bill_id
        ]);

        return redirect(route('dashboard', absolute: false));
    }
}

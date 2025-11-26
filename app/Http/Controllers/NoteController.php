<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create($bill_id)
    {
        return view('note.create', ['bill_id' => $bill_id, 'bill_message' => '', 'state' => 'POST']);
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

    public function show($bill_id)
    {
        $message = Note::where('bill_id', $bill_id)->first()->message;
        return view('note.show', ['bill_id' => $bill_id, 'bill_message' => $message, 'state' => 'SHOW']);
    }

    public function edit($note_id){
        $note_message = Note::where('id', $note_id)->first()->message;
        return view('note.edit', ['note_id' => $note_id, 'bill_message' => $note_message, 'state' => 'PUT']);
    }

    public function update($bill_id, Request $request)
    {
        $request->validate([
            'message' => 'string|required|min:10',
            'bill_id' => 'required'
        ]);

        $bill = Bill::where('id', $bill_id)->first();
        $note = $bill->note;
        $note->update([
            'message' => $request->message,
            'bill_id' => $request->bill_id
        ]);

        return redirect(route('dashboard', absolute: false));
    }

    public function delete($bill_id)
    {
        $bill = Bill::where('id', $bill_id)->first();
        $note = $bill->note;
        $note->delete();

        return redirect(route('dashboard', absolute: false));
    }
}

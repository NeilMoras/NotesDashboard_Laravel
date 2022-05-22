<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        // dd($notes);
        // $notes =  Auth::user()->notes()->latest('updated_at')
        // ->paginate(5);

        // OR inverse relationship
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        return view('notes.create')->with('notes', $notes);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text'  =>  'required'
        ]);

        Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'language' => $request->language,
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  Route model binding,Injecting the entire model to the route
    public function show(Note $note)
    {
        // $note = Note::where('uuid', $uuid)->where('user_id', Auth::id())->firstOrFail();

        // if the user id does not match the login id the throw an error
        //if the notes user id not autherised to the user note then abort
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, note $note)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text'  =>  'required',
            'language'  =>  'required'
        ]);

        $note->update([
            'language' => $request->language,
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('notes.show', $note)->with('success', 'Note Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {

        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note moved to trash Successfully');
    }


    // public function javascript()
    // {
    //     return view('notes.javascript');
    // }
}

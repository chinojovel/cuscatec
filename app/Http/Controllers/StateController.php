<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "edit"]);
    }
    public function index()
    {
        $states = State::paginate(10);
        return view('states.index', compact('states'));
    }

    public function create()
    {
        return view('states.create');
    }

    public function store(Request $request)
    {;
        $request->validate([
            'name' => 'required|string|max:255|unique:states',
            'abbreviation' => 'required|string|max:5|unique:states',
        ]);

        State::create($request->all());

        return redirect()->route('states.index')->with('success', 'State created successfully.');
    }

    public function show(State $state)
    {
        return view('states.show', compact('state'));
    }

    public function edit(State $state)
    {
        return view('states.edit', compact('state'));
    }

    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:states,name,' . $state->id,
            'abbreviation' => 'required|string|max:5|unique:states,abbreviation,' . $state->id,
        ]);

        $state->update($request->all());

        return redirect()->route('states.index')->with('success', 'State updated successfully.');
    }

    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('states.index')->with('success', 'State deleted successfully.');
    }


    /**
     * Metodos para api
     */


     public function getStatesApi()
    {
        $states = State::all();
        return response()->json($states);
    }
}

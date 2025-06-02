<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseRecord;
use Illuminate\Support\Facades\Auth;

class ExerciseRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display all exercise records
    public function index()
    {
        $exerciseRecords = Auth::user()->exerciseRecords()->get();
        return view('exercise_records.index', compact('exerciseRecords'));
    }

    // Show the form for creating a new record
    public function create()
    {
        return view('exercise_records.create');
    }

    // Store a new record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exercise_name' => 'required|string|max:255',
            'calories_burned' => 'required|integer|min:0',
            'duration' => 'nullable|integer|min:0',
            'date' => 'required|date',
            'time' => 'nullable',
            'notes' => 'nullable|string',
            'youtube_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',

            


        ]);

        Auth::user()->exerciseRecords()->create([
            'exercise_name' => $validated['exercise_name'],
            'calories_burned' => $validated['calories_burned'],
            'duration' => $validated['duration'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'notes' => $validated['notes'] ?? null,
            'youtube_url' => $validated['youtube_url'] ?? null,
        ]);
    
    

        return redirect()->route('exercise-records.index')
            ->with('success', '💪 Exercise record has been saved!');
    }

    // Show details of a specific record
    public function show(ExerciseRecord $exerciseRecord)
    {
        if ($exerciseRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view this record.');
        }
        return view('exercise_records.show', compact('exerciseRecord'));
    }

    // Show edit form
    public function edit(ExerciseRecord $exerciseRecord)
    {
        if ($exerciseRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this record.');
        }
        return view('exercise_records.edit', compact('exerciseRecord'));
    }

    // Update the record
    public function update(Request $request, ExerciseRecord $exerciseRecord)
    {
        if ($exerciseRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to update this record.');
        }

        $validated = $request->validate([
            'exercise_name' => 'required|string|max:255',
            'calories_burned' => 'required|integer|min:0',
            'duration' => 'nullable|integer|min:0',
            'date' => 'required|date',
            'time' => 'nullable',
            'notes' => 'nullable|string',
            'youtube_url' => 'nullable|url',
        ]);

        $exerciseRecord->update($validated);

        return redirect()->route('exercise-records.index')
            ->with('success', '✏️ Exercise record has been updated!');
    }

    // Delete a record
    public function destroy(ExerciseRecord $exerciseRecord)
    {
        if ($exerciseRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this record.');
        }

        $exerciseRecord->delete();

        return redirect()->route('exercise-records.index')
            ->with('success', '🗑️ Exercise record has been deleted!');
    }
}

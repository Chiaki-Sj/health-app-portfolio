<?php

namespace App\Http\Controllers;

use App\Models\FoodRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display all food records
    public function index()
    {
        $foodRecords = Auth::user()->foodRecords()->get();

        return view('food_records.index', compact('foodRecords'));
    }

    // Show the form for creating a new record
    public function create()
    {
        return view('food_records.create');
    }

    // Store a new record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
            'date' => 'required|date',
            'time' => 'nullable',
            'meal_type' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:3048',
            'notes' => 'nullable|string',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('food_images', 'public');
        }

        // Save the record
        Auth::user()->foodRecords()->create([
            'food_name' => $validated['food_name'],
            'calories' => $validated['calories'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'meal_type' => $validated['meal_type'] ?? null,
            'image_path' => $imagePath,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('food-records.index')
            ->with('success', '🍽️ Food record has been saved!');
    }

    // Show details of a specific record
    public function show(FoodRecord $foodRecord)
    {
        if ($foodRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view this record.');
        }
        return view('food_records.show', compact('foodRecord'));
    }

    // Show edit form
    public function edit(FoodRecord $foodRecord)
    {
        if ($foodRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this record.');
        }
        return view('food_records.edit', compact('foodRecord'));
    }

    // Update the record
    public function update(Request $request, FoodRecord $foodRecord)
    {
        if ($foodRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to update this record.');
        }

        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
            'date' => 'required|date',
            'time' => 'nullable',
            'meal_type' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($foodRecord->image_path) {
                Storage::disk('public')->delete($foodRecord->image_path);
            }
            $imagePath = $request->file('image')->store('food_images', 'public');
            $foodRecord->image_path = $imagePath;
        }

        // Update the record
        $foodRecord->update([
            'food_name' => $validated['food_name'],
            'calories' => $validated['calories'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'meal_type' => $validated['meal_type'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('food-records.index')
            ->with('success', '✏️ Food record has been updated!');
    }

    // Delete a record
    public function destroy(FoodRecord $foodRecord)
    {
        if ($foodRecord->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this record.');
        }

        if ($foodRecord->image_path) {
            Storage::disk('public')->delete($foodRecord->image_path);
        }

        $foodRecord->delete();

        return redirect()->route('food-records.index')
            ->with('success', '🗑️ Food record has been deleted!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Subject;

use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|unique:subjects|max:10',
                'name' => 'required|max:255',
                'units' => 'required|integer|min:1',
            ]);

            Subject::create($request->all());
            return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('subjects.index')->with('error', 'An error occurred while creating the subject: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        try {
            $validated = $request->validate([
                'code' => 'required|max:10|unique:subjects,code,' . $subject->id,
                'name' => 'required|max:255',
                'units' => 'required|integer|min:1',
            ]);
        
            $subject->update($validated);
        
            return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('subjects.index')->with('error', 'An error occurred while updating the subject: ' . $e->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject->status === 'verified') {
            return redirect()->route('subjects.index')->with('error', 'Cannot delete a verified subject.');
        }
    
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
    
}

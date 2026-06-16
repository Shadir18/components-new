<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->simplePaginate(5);
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => ['required', 'min:5'],
            'company' => ['required'],
            'salary' => ['required']
        ]);

        Job::create($request->all());
        return redirect()->route('jobs.index')->with('success', 'job cerated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('index', [
            'job' => $job,
            'jobs' => Job::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:5'],
            'company' => ['required'],
            'salary' => ['required']
        ]);

        Job::update($request->all());
        return redirect()->route('jobs.index')->with('success', 'job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully');
    }
}

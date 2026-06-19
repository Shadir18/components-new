<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

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
        $attributes = $request->validate([
            'title' => ['required', 'min:5'],
            'company' => ['required'],
            'salary' => ['required']
        ]);
        $employer = Auth::user()->employer;
        if (! $employer) {
            abort(403, 'You must be an employer to post jobs');
        }
        $attributes['employer_id'] = $employer->id;
        Job::create($attributes);
        return response()->json([
            'message' => 'Job listing posted successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:5'],
            'company' => ['required'],
            'salary' => ['required']
        ]);

        $job->update($attributes);
        return response()->json([
            'success' => true,
            'message' => 'Job updated successfully!',
            'job' => $job,
            'redirect_url' => '/jobs/' . $job->id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Job $job)
    {
        $job->delete();
        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully!',
            'redirect_url' => '/jobs'
        ], 200);
    }
}

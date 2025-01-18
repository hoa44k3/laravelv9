<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class JobController extends Controller
{
    
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

   
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

   
    public function create()
    {
        $users = User::all();
        return view('jobs.create',compact('users'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'job_date' => 'required|date',
            'image' => 'nullable|image',
        ]);

        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('job_images', 'public');
        }

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'job_date' => $request->job_date,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

     public function edit($id)
    {
        $job = Job::findOrFail($id);
        $users = User::all();
        return view('jobs.edit', compact('job','users'));
    }
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'job_date' => 'required|date',
            'image' => 'nullable|image',
        ]);

        $job = Job::findOrFail($id);

        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('job_images', 'public');
            $job->image = $imagePath;
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'job_date' => $request->job_date,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

   
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}

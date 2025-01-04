<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
class JobController extends Controller
{
    // Hiển thị danh sách các công việc
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    // Hiển thị chi tiết một công việc
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    // Tạo công việc mới
    public function create()
    {
        return view('jobs.create');
    }

    // Lưu công việc mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'job_date' => 'required|date',
            'image' => 'nullable|image',
        ]);

        // Xử lý hình ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('job_images', 'public');
        }

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'job_date' => $request->job_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    // Chỉnh sửa công việc
     public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }
    // public function edit(Job $job) // Đảm bảo nhận đối tượng Job
    // {
    //     return view('jobs.edit', compact('job'));
    // }
    
    // Cập nhật công việc
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'job_date' => 'required|date',
            'image' => 'nullable|image',
        ]);

        $job = Job::findOrFail($id);

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('job_images', 'public');
            $job->image = $imagePath;
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'job_date' => $request->job_date,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    // Xóa công việc
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}

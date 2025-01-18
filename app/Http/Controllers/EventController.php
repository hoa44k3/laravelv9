<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        foreach ($events as $event) {
            $event->event_date = Carbon::parse($event->event_date);
        }
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $users = User::all();
        return view('events.create',compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
        }
      

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'image' =>  $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Sự kiện đã được tạo thành công.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $users = User::all();
        return view('events.edit', compact('event','users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::findOrFail($id);
        if ($request->hasFile('image')) {
           
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
           
            $imagePath = $request->file('image')->store('event_images', 'public');
            $event->image = $imagePath; 
        }
        
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'user_id' => Auth::id(),
            'image' => $event->image,
        ]);
      
        return redirect()->route('events.index')->with('success', 'Sự kiện đã được cập nhật.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Sự kiện đã được xóa.');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

}

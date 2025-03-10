<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user,ctv',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('avatars', 'public');
        }
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'ctv';
        User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'Người dùng đã được thêm thành công!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); 
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:admin,user,ctv', 
            'birthday' => 'nullable|date',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $validatedData['image'] = $request->file('image')->store('avatars', 'public');
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Người dùng đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->delete();
            return response()->json(['success' => 'Người dùng đã được xóa!']);
        }

    return response()->json(['error' => 'Người dùng không tồn tại!'], 404);
    }
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('users.profile', compact('user'));
    }

}

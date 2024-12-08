<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function index()
    {
        return view('auth.login');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register'); 
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public'); // Lưu ảnh vào thư mục public/storage/users
        }
        if ($validator->fails()) {
            return redirect()->route('auth.register')
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo tài khoản mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
        ]);

        // Chuyển hướng đến trang đăng nhập hoặc dashboard
        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }
    

    // Xử lý đăng nhập
    public function login(Request $request)
    {
       Log::info('Email:', ['email' => $request->email]);
       Log::info('Password:', ['password' => $request->password]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('backend.dashboard.index'); 
            } else {
                return redirect()->route('index'); 
        }
       
    }
    return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index')->with('success', 'Bạn đã đăng xuất thành công');
    }
    
}

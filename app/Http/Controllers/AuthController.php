<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
    public function register(AuthRequest $request)
    {
        
        // Validate dữ liệu
        $request->validate([
           'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:8|confirmed',
        ]);
        // Kiểm tra email tồn tại
        // if (User::where('email', $request->input('email'))->exists()) {
        //     return redirect()->back()->with('error', 'Email đã tồn tại');
        // }

        // Tạo người dùng mới
        $user = new User();
        $user->name = $request->input('name','Người dùng'); // Nếu có trường 'name' trong form
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'user'; // Mặc định role là 'user'
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công');
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

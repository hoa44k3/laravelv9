<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {

        return view('auth.login');
    }
    public function register(AuthRequest $request)
    {
        
     if (User::where('email', $request->input('email'))->exists()) {
         return redirect()->back()->with('error', 'Email đã tồn tại');
     }

    $user = new User();
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->save();

    Auth::login($user);

    // Chuyển hướng về trang dashboard
    return redirect()->route('dashboard.index')->with('success', 'Đăng ký thành công');

    // return redirect()->route('auth.admin')->with('success', 'Đăng ký thành công');
    }
    public function login(AuthRequest $request)
    {
    
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
            return redirect()->route("dashboard.index");
          
        }

        return redirect()->route('auth.admin')->with('error', 'Email hoặc Mật khẩu không chính xác');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin')->with('success', 'Bạn đã đăng xuất thành công');
    }
}

?>
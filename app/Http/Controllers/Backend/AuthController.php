<?php
namespace App\Http\Controllers\Backend;
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

        return view('backend.auth.login');
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



    // return redirect()->route('auth.admin')->with('success', 'Đăng ký thành công');
    }
    public function login(AuthRequest $request)
    {
    
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
           // $request->session()->put("messenge", ["style"=>"success","msg"=>"Đăng nhập quyền quản trị thành công"]);
            return redirect()->route("dashboard.index");
          
        }

        return redirect()->route('auth.admin')->with('error', 'Email hoặc Mật khẩu không chính xác');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('auth.admin')->with('success', 'Bạn đã đăng xuất thành công');
    }
}

?>
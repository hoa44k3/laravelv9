<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        // $template = 'backend.user.index';
        // return view('backend.dashboard.index', compact('template'));
        $users = User::all();  // Lấy tất cả người dùng từ database
        return view('backend.user.index', compact('users'));
    }
    // Hiển thị form sửa người dùng
    public function create()
    {
        return view('backend.user.create');  // Hiển thị form thêm người dùng
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'address' => 'required|string',
            'birthday' => 'required|date|date_format:Y-m-d',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);
        

        // Tạo người dùng mới sau khi đã validate
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Mã hóa mật khẩu
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthday = Carbon::createFromFormat('Y-m-d', $request->birthday); // Chuyển đổi thành đối tượng Carbon
        $user->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
            $user->image = $imagePath;
        }
        $user->save();

        return redirect()->route('backend.user.index')->with('success', 'Người dùng đã được thêm thành công.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);  // Lấy người dùng cần sửa
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string',
            'address' => 'required|string',
            'birthday' => 'required|date|date_format:Y-m-d',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthday = Carbon::createFromFormat('Y-m-d', $request->birthday)->format('Y-m-d'); // Chuyển đổi thành định dạng ngày
        $user->description = $request->description;
        // Chỉ cập nhật mật khẩu nếu có
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        // Nếu có tải lên ảnh mới, lưu vào storage
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('image', 'public');
        $user->image = $imagePath;
    }


        $user->save();

        return redirect()->route('backend.user.index')->with('success', 'Người dùng đã được cập nhật thành công.');

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();  // Xóa người dùng
        return redirect()->route('backend.user.index')->with('success', 'User deleted successfully');
    }

}

?>
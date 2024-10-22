<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function index(){
        return view('admin.index');
    }
    public function register(){
        $objAdmin = new Admin();
        $this->view['listAdmin']= $objAdmin->loadListAdmin();
        return view('admin.register',$this->view);
    }
    public function postRegister(Request $request){
        $objAdmin = new Admin();
        $request->merge(['password'=>Hash::make($request->password)]);
        $res = $objAdmin->insertDataAdmin($request->all());
        if($res){
            return redirect()->back()->with('success','Đăng ký tài khoản thành công!');
        } else {
            return redirect()->back()->with('error','Đăng ký tài khoản không thành công!');
        }
    }
    public function login(){
        return view('admin.login');
    }
    public function postLogin(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with('error','Đăng nhập tài khoản không thành công!');
        }
    }
    public function changePassword(){
        return view('admin.changePassword');
    }
    public function postChange(Request $request){
        if (!Hash::check($request->current_password, Auth::admin()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác!']);
        }

        $admin = Auth::admin();
        $admin->password = Hash::make($request->new_password);
        $admin->save();
    
        return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công');
    }
    public function sigout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}

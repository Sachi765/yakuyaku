<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Constants\CommonConstants;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    // 管理者一覧画面表示
    function index(){
        $admins = User::where('role', CommonConstants::ROLE_ADMIN)->get();
    
        return view('admin.index',['users'=>$admins]);
    }

    // 管理者登録画面表示
    function create(){
        return view('admin.create');
    }

    // 管理者を作成するメソッド
    function store(Request $request){

        $today = now();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login_id' => ['required', 'integer', 'digits:5', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'login_id' => $request->login_id,
            'role' => CommonConstants::ROLE_ADMIN,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('admin.index')->with('message', '管理者が作成されました');
    }

    // 管理者変更画面表示
    function edit($id){
        $admin = User::findOrFail($id);
        return view('admin.edit',['admin'=>$admin]);
    }

    // 管理者を変更するメソッド
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login_id' => ['required', 'integer', 'digits:5', 'unique:users,login_id,'.$id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin->name = $request->name;
        $admin->login_id = $request->login_id;
        
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        
        $admin->save();

        return redirect()->route('admin.index')->with('message', '管理者情報が更新されました');
    }

    // 管理者を削除するメソッド
    public function delete(Request $request)
    {
        $admin = User::findOrFail($request->id);
        $admin->delete();

        return redirect()->route('admin.index')->with('message', '管理者が削除されました');
    }

}

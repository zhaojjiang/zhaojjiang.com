<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login()
    {
        $data = $this->request->only(['uname', 'password']);
        $validator = Validator::make($data, [
            'uname' => ['required'],
            'password' => ['required'],
        ], [
            'uname.required' => '请输入用户名',
            'password.required' => '请输入密码',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with('err_msg', $validator->messages()->first());
        }
        $user = User::query()->where('uname', $data['uname'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->withInput()->with('err_msg', '用户名或密码错误');
        }

        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

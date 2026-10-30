<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->data['webTitle'] = env('APP_WEB_TITLE') ?: config('app.name');
    }

    public function login()
    {
        $this->data['pageTitle'] = 'Login Pengelola';
        return view('templates.adminlte.v_login', $this->data);
    }

    public function submit_login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('username', 'password'))) {
            return back()->with('error', 'Nama pengguna atau password salah!');
        }

        if (Auth::user()->is_delete === 'Y') {
            auth()->logout();
            return back()->with('error', 'Akun Anda sudah tidak aktif. Hubungi Administrator.');
        }

        return redirect('account/dashboard');
    }

    public function register()
    {
        $this->data['pageTitle'] = 'Daftar Warga';
        return view('templates.adminlte.v_register', $this->data);
    }

    public function submit_register(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|max:20|unique:tbl_pengguna,nik',
            'nama' => 'required|min:3|max:50',
            'username' => 'required|min:4|max:50|unique:tbl_pengguna,nama_pengguna',
            'no_telepon' => 'nullable|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'nama_pengguna' => $request->username,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon ?: '',
            'role' => 'Warga',
            'role_id' => 3,
            'foto' => '',
            'is_delete' => 'N',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }

    public function forgot()
    {
        $this->data['pageTitle'] = 'Lupa Password';
        return view('templates.adminlte.v_forgot', $this->data);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}

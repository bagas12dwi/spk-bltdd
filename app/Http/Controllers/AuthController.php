<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $request->session()->regenerate();
            Alert::toast('Login Berhasil!', 'success');
            return redirect()->route('dashboard');
        }

        Alert::error('Gagal!', 'Email atau Password tidak sesuai!');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function ubahPassword()
    {
        return view('auth.ubah-password', [
            'title' => 'Ubah Password',
        ]);
    }

    public function ubahPasswordStore(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            Alert::error('Gagal', 'Password lama tidak sesuai!');
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Alert::success('Berhasil', 'Password berhasil diubah!');
        return back()->with('success', 'Password berhasil diubah.');
    }
}

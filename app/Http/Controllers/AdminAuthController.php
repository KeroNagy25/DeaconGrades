<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminYear;


class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['email'=>'بيانات الدخول خاطئة']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function showSignupForm()
    {
        $years = [
        'حضانة', 'اولى ابتدائى', 'ثانية ابتدائى', 'ثالثة ابتدائى',
        'رابعة ابتدائى', 'خامسة ابتدائى', 'سادسة ابتدائى',
        'اولى اعدادى', 'ثانية اعدادى', 'ثالثة اعدادى',
        'اولى ثانوى', 'ثانية ثانوى', 'ثالثة ثانوى'
    ];
        return view('admin.signup', compact('years'));
    }
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'academic_years' => 'required|array|min:1',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ربط admin بالسنوات
        foreach ($request->academic_years as $year) {
            AdminYear::create([
                'admin_id' => $admin->id,
                'academic_year' => $year,
            ]);
        }

        return redirect()->route('admin.login')->with('success', 'تم إنشاء المسؤول بنجاح');
    }
}

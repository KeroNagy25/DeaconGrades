@extends('layouts.admin')
@section('title', 'تسجيل دخول المسؤول')
@section('content')

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-8 ">
        <h2 class="text-2xl font-bold mb-6 text-center text-red-900">تسجيل دخول المسؤول</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" required
                       class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-red-900"
                       placeholder="admin@example.com">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">كلمة المرور</label>
                <input type="password" name="password" required
                       class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-red-900"
                       placeholder="********">
            </div>

            <button type="submit"
                    class="w-full bg-red-900 hover:bg-red-800 text-white py-3 rounded font-semibold shadow-md transition-colors">
                تسجيل الدخول
            </button>
        </form>
    </div>
</div>
@endsection




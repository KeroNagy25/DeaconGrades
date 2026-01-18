@extends('layouts.admin')
@section('title', 'تسجيل مسؤول جديد')
@section('content')

<div class="flex items-center justify-center min-h-screen">
<div class="bg-white shadow-lg rounded-lg w-full max-w-md p-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-red-900">تسجيل مسؤول جديد</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.signup.submit') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium text-gray-700">الاسم</label>
            <input type="text" name="name" required
                   class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-red-900"
                   placeholder="أدخل الاسم">
        </div>

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

        <div>
            <label class="block mb-1 font-medium text-gray-700">اختر السنوات المسؤل عنها</label>
            <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto border p-2 rounded">
                @foreach($years as $year)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="academic_years[]" value="{{ $year }}" class="rounded">
                        <span>{{ $year }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit"
                class="w-full bg-red-900 hover:bg-red-800 text-white py-3 rounded font-semibold shadow-md transition-colors">
            تسجيل المسؤول
        </button>
    </form>

</div>
</div>
@endsection



@extends('layouts.admin')

@section('title', 'إدارة الطلبة')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-red-900">🔍 البحث عن المخدوم</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-4 border border-green-200">
        {{ session('success') }}
    </div>
@endif

 <!-- Search Form -->
<form action="{{ route('admin.search') }}" method="GET"
      class="flex flex-col md:flex-row gap-3 mb-6 items-center">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="اسم المخدوم أو رقم التليفون"
        class="flex-1 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-900"
    >
    <button type="submit"
            class="bg-red-900 hover:bg-red-800 text-white px-6 py-2 rounded-lg font-semibold shadow-md">
        بحث
    </button>
</form> 

<div class="overflow-x-auto">
    <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
        
        <thead class="bg-red-900 text-white uppercase text-sm">
            <tr>
                <th class="p-3 text-right">الاسم</th>
                <th class="p-3 text-right">السنة</th>
                <th class="p-3 text-right">المجموع</th>
                <th class="p-3 text-center">تعديل</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr class="border-b hover:bg-red-50">
                    <td class="p-3 text-red-900 font-medium">{{ $student->full_name }}</td>
                    <td class="p-3 text-red-900">{{ $student->academic_year }}</td>
                    <td class="p-3 font-bold text-red-900">{{ $student->total }}</td>
                    <td class="p-3 text-center">
                        <a href="{{ route('admin.edit', $student->id) }}"
                           class="bg-red-900 hover:bg-red-800 text-white px-4 py-1 rounded">
                           تعديل
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        لا يوجد طلبة
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6 flex justify-center">
    {{ $students->links('pagination::tailwind') }}
</div>

@endsection

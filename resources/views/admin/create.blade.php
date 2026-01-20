@extends('layouts.admin')

@section('title', 'إضافة طالب جديد')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-red-900">➕ إضافة طالب جديد</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-4 border border-green-200">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.store') }}" method="POST"
      class="bg-white p-6 rounded-lg shadow-lg max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
    @csrf

    <div>
        <label class="block mb-1 font-medium text-red-900">اسم الطالب</label>
        <input type="text" name="full_name" value="{{ old('full_name') }}"
               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900" required>
    </div>

    <div>
        <label class="block mb-1 font-medium text-red-900">العمر</label>
        <input type="number" name="age" value="{{ old('age') }}"
               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900" required>
    </div>

    <div>
        <label class="block mb-1 font-medium text-red-900">السنة الدراسية</label>
        <input type="text" name="academic_year" value="{{ old('academic_year') }}"
               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900" required>
    </div>

    <div>
        <label class="block mb-1 font-medium text-red-900">النوع</label>
        <select name="gender" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900" required>
            <option value="" disabled selected>— اختر —</option>
            <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
            <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
        </select>
    </div>

    <div>
        <label class="block mb-1 font-medium text-red-900">رتبة الشمامسة</label>
        <select name="deacon_rank" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
            <option value="" selected>— اختر —</option>
            <option value="ابسلتس">ابسلتس</option>
            <option value="اغنسطس">اغنسطس</option>
            <option value="ابيدياكون">ابيدياكون</option>
            <option value="دياكون">دياكون</option>
            <option value="ارشيدياكون">ارشيدياكون</option>
        </select>
    </div>

    {{-- للحضانة --}}
    <div>
        <label class="block mb-1 font-medium text-red-900">التقييم (للحضانة)</label>
        <select name="evaluation" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
            <option value="" selected>— اختر —</option>
            <option value="ممتاز">ممتاز</option>
            <option value="جيد جدًا">جيد جدًا</option>
            <option value="جيد">جيد</option>
        </select>
    </div>

    @foreach([
        'phone' => 'رقم التليفون',
        'attendance_count' => 'عدد الحضور',
        'attendance_grade' => 'درجة الحضور',
        'hymns_grade' => 'درجة الألحان',
        'coptic_grade' => 'درجة القبطي',
        'theology_grade' => 'درجة الطقس',
        'total' => 'المجموع'
    ] as $field => $label)
        <div>
            <label class="block mb-1 font-medium text-red-900">{{ $label }}</label>
            <input type="text" name="{{ $field }}" value="{{ old($field) }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900"
                   @if($field == 'total') readonly @endif>
        </div>
    @endforeach

    <div class="md:col-span-2 text-center mt-4">
        <button type="submit" class="bg-red-900 hover:bg-red-800 text-white px-10 py-3 rounded-lg font-semibold shadow-md transition-colors duration-200">
            إضافة الطالب
        </button>
    </div>
</form>

@endsection

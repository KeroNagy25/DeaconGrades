@extends('layouts.admin')

@section('title', 'تعديل الطالب')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-red-900">✏️ تعديل بيانات الطالب</h2>

<form action="{{ route('admin.update', $student->id) }}"
      method="POST"
      class="bg-white p-6 rounded-lg shadow-lg max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
    @csrf


    <div>
        <label class="block mb-1 font-medium text-red-900">اسم الطالب</label>
        <input type="text" name="full_name" value="{{ $student->full_name }}"
               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
    </div>


    <div>
        <label class="block mb-1 font-medium text-red-900">العمر</label>
        <input type="number" name="age" value="{{ $student->age }}"
               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
    </div>

    <div>
        <label class="block mb-1 font-medium text-red-900">السنة الدراسية</label>
        <input type="text" name="academic_year" value="{{ $student->academic_year }}"
               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
    </div>


    <div>
        <label class="block mb-1 font-medium text-red-900">النوع</label>
        <select name="gender" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
            <option value="ذكر" {{ $student->gender == 'ذكر' ? 'selected' : '' }}>ذكر</option>
            <option value="أنثى" {{ $student->gender == 'أنثى' ? 'selected' : '' }}>أنثى</option>
        </select>
    </div>


    <div>
        <label class="block mb-1 font-medium text-red-900">رتبة الشمامسة</label>
        <select name="deacon_rank" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
            <option value="" {{ $student->deacon_rank == '' ? 'selected' : '' }}>— اختر —</option>
            <option value="ابسلتس" {{ $student->deacon_rank == 'ابسلتس' ? 'selected' : '' }}>ابسلتس</option>
            <option value="اغنسطس" {{ $student->deacon_rank == 'اغنسطس' ? 'selected' : '' }}> اغنسطس</option>
            <option value="ابيدياكون" {{ $student->deacon_rank == 'ابيدياكون' ? 'selected' : '' }}>ابيدياكون</option>
            <option value="دياكون" {{ $student->deacon_rank == 'دياكون' ? 'selected' : '' }}>دياكون</option>
            <option value="ارشيدياكون" {{ $student->deacon_rank == 'ارشيدياكون' ? 'selected' : '' }}>ارشيدياكون</option>
        </select>
    </div>


    @foreach([
        'phone' => 'رقم التليفون',
        'attendance_count' => 'عدد الحضور',
        'attendance_grade' => 'درجة الحضور',
        'hymns_grade' => 'درجة الألحان',
        'coptic_grade' => 'درجة القبطي',
        'theology_grade' => 'درجة الطقس',
    ] as $field => $label)
        <div>
            <label class="block mb-1 font-medium text-red-900">{{ $label }}</label>
            <input type="text" name="{{ $field }}" value="{{ $student->$field }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-red-900">
        </div>
    @endforeach
    <div>
    <label class="block mb-1 font-medium text-red-900">المجموع</label>
    <input type="text" name="total" value="{{ $student->total }}"
           readonly
           class="w-full p-3 border rounded-lg bg-gray-100 cursor-not-allowed">
</div>


    
    <div class="md:col-span-2 text-center mt-4">
        <button type="submit" class="bg-red-900 hover:bg-red-800 text-white px-10 py-3 rounded-lg font-semibold shadow-md transition-colors duration-200">
            حفظ التعديل
        </button>
    </div>
</form>

@endsection

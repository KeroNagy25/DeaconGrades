@extends('layouts.student')

@section('title', 'Result - St John Deacon School')

@section('content')

<div class="max-w-3xl mx-auto mt-16 px-4">

    @if($students->isEmpty())
        <div class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 rounded-lg shadow text-center font-semibold">
            ❌ لم يتم العثور على بيانات
        </div>
    @else
        @foreach($students as $student)
            <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border border-gray-200 transition-transform duration-200 hover:scale-105">
                <h3 class="text-xl font-bold mb-4 text-red-900 border-b pb-2">النتيجة</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <strong class="text-red-900">الاسم:</strong> {{ $student->full_name }}
                    </div>
                    <div>
                        <strong class="text-red-900">السنة الدراسية:</strong> {{ $student->academic_year }}
                    </div>
                    <div>
                        <strong class="text-red-900">رقم التليفون:</strong> {{ $student->phone ?? 'غير محدد' }}
                    </div>
                    <div>
                        <strong class="text-red-900">السن:</strong> {{ $student->age }}
                    </div>
                    <div>
                        <strong class="text-red-900">النوع:</strong> {{ $student->gender }}
                    </div>
                    <div>
                        <strong class="text-red-900">رتبة الشمامسة:</strong> {{ $student->deacon_rank ?? 'غير محددة' }}
                    </div>
                    <div>
                        <strong class="text-red-900">عدد مرات الحضور من 8:</strong> {{ $student->attendance_count }}
                    </div>

                    @if(\Illuminate\Support\Str::contains($student->academic_year, 'حضانة'))
                        <div class="col-span-2">
                            <strong class="text-red-900">التقييم:</strong> {{ $student->evaluation ?? 'لم يتم التقييم بعد' }}
                        </div>
                    @else
                        <div>
                            <strong class="text-red-900">درجة الحضور:</strong> {{ $student->attendance_grade }}
                        </div>
                        <div>
                            <strong class="text-red-900">درجة الألحان:</strong> {{ $student->hymns_grade }}
                        </div>
                        <div>
                            <strong class="text-red-900">درجة القبطي:</strong> {{ $student->coptic_grade }}
                        </div>
                        <div>
                            <strong class="text-red-900">درجة الطقس:</strong> {{ $student->theology_grade }}
                        </div>
                        <div class="col-span-2">
                            <strong class="text-red-900">المجموع الكلي:</strong> {{ $student->total_grade }}
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <p class="text-center text-gray-600 mt-4">
        من فضلك احتفظ بالنتيجة كلقطة شاشة (screenshot)
    </p>

    <div class="mt-6 flex justify-center">
        {{ $students->withQueryString()->links('pagination::tailwind-custom') }}
    </div>
</div>

@endsection

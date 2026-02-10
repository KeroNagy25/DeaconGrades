<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }
   public function search(Request $request)
{
    $request->validate([
        'query' => [
            'required',
            function ($attribute, $value, $fail) {
                if (is_numeric($value)) {
                    if (!preg_match('/^01\d{9}$/', $value)) {
                        $fail('رقم التليفون يجب أن يكون 11 رقم ويبدأ بـ 01.');
                    }
                } else {
                    $words = preg_split('/\s+/u', trim($value));
                    if (count($words) < 2) {
                        $fail('الرجاء كتابة الاسم كاملاً (ثنائي) أو رقم التليفون بالكامل.');
                    }
                }
            }
        ]
    ]);

    $search = trim($request->input('query'));

    // تطبيع كلمة البحث
    $normalizedSearch = str_replace(
        ['أ', 'إ', 'آ', 'ى'],
        ['ا', 'ا', 'ا', 'ي'],
        $search
    );

    $students = Student::where(function ($q) use ($normalizedSearch, $search) {

        $q->whereRaw("
            REPLACE(
                REPLACE(
                    REPLACE(
                        REPLACE(full_name, 'أ', 'ا'),
                    'إ', 'ا'),
                'آ', 'ا'),
            'ى', 'ي')
            LIKE ?
        ", ["%{$normalizedSearch}%"])

        ->orWhere('phone', 'LIKE', "%{$search}%");
    })
    ->paginate(1);

    if ($students->isEmpty()) {
        return redirect()->route('student.index')
            ->with('noResult', '❌ خطأ في الاسم أو رقم التليفون، الرجاء المحاولة مرة أخرى.')
            ->withInput();
    }

    return view('student.result', compact('students'));
}

}

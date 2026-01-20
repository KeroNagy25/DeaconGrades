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
                // لو القيمة عبارة عن أرقام فقط => رقم تلفون
                if (is_numeric($value)) {
    if (!preg_match('/^01\d{9}$/', $value) && !Student::where('phone', $value)->exists()) {
        $fail('رقم التليفون يجب أن يكون 11 رقم ويبدأ بـ 01.');
    }
                }   
    else {
                    // الاسم يجب أن يكون كلمتين على الأقل
                    $words = preg_split('/\s+/', trim($value));
                    if (count($words) < 2) {
                        $fail('الرجاء كتابة الاسم كاملاً (ثنائي) أو رقم التليفون بالكامل.');
                    }
                }
            }
        ]
    ]);

    $search = $request->input('query');

    $students = Student::where('full_name', 'LIKE', "%{$search}%")
        ->orWhere('phone', 'LIKE', "%{$search}%")
        ->paginate(1);

        if ($students->isEmpty()) {
        return redirect()->route('student.index')
                         ->with('noResult', '❌خطأ في الاسم او رقم التليفون ، الرجاء المحاولة مرة أخرى.')
                         ->withInput();
    }

    return view('student.result', compact('students'));
    }

}

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

                // رقم تليفون
                if (is_numeric($value)) {
                    if (!preg_match('/^01\d{9}$/', $value)) {
                        $fail('رقم التليفون يجب أن يكون 11 رقم ويبدأ بـ 01.');
                    }
                } 
                // اسم
                else {
                    $normalized = $this->normalizeArabic($value);
                    $words = preg_split('/\s+/u', $normalized);

                    if (count($words) < 2) {
                        $fail('الرجاء كتابة الاسم ثنائي على الأقل (مثال: كيرلس ناجي).');
                    }
                }
            }
        ]
    ]);

    $searchRaw = $request->input('query');
    $searchNormalized = $this->normalizeArabic($searchRaw);

    // نجيب كل الطلبة ونفلتر يدوي (عشان التطبيع)
    $students = Student::all()->filter(function ($student) use ($searchNormalized, $searchRaw) {

        $normalizedName = $this->normalizeArabic($student->full_name);

        return str_contains($normalizedName, $searchNormalized)
            || str_contains($student->phone, $searchRaw);
    });

    if ($students->isEmpty()) {
        return redirect()->route('student.index')
            ->with('noResult', '❌ خطأ في الاسم أو رقم التليفون، الرجاء المحاولة مرة أخرى.')
            ->withInput();
    }

    // pagination يدوي
    $students = new \Illuminate\Pagination\LengthAwarePaginator(
        $students->forPage(1, 1),
        $students->count(),
        1,
        1,
        ['path' => request()->url()]
    );

    return view('student.result', compact('students'));
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\AdminYear;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admin = Auth::guard('admin')->user();
        if ($admin->superadmin) {
        $students = Student::paginate(10);
        }
        else {
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();
        $students = Student::whereIn('academic_year', $years)->paginate(10);
        }
        return view('admin.index', compact('students'));
        
    }
    public function search(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $search = $request->input('search');
        if ($admin->superadmin) {
        $students = Student::where(function($query) use ($search) {
                                $query->where('full_name', 'LIKE', "%{$search}%")
                                      ->orWhere('phone', 'LIKE', "%{$search}%");
                            })
                            ->paginate(10);
        }
        else {
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();
        $students = Student::whereIn('academic_year', $years) 
                            ->where(function($query) use ($search) {
                                $query->where('full_name', 'LIKE', "%{$search}%")
                                      ->orWhere('phone', 'LIKE', "%{$search}%");
                            })
                            ->paginate(10);
        }

        return view('admin.index', compact('students'));

    }
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        if($admin->superadmin) {
        $student = Student::findOrFail($id);
        }
        else {
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();

        $student = Student::whereIn('academic_year', $years)->findOrFail($id);
        }

        return view('admin.edit', compact('student'));
    }
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        if($admin->superadmin) {
        $student = Student::findOrFail($id);
        }
        else {
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();

        $student = Student::whereIn('academic_year', $years)->findOrFail($id);
        }
        if (str_contains($student->academic_year, 'حضانة')) {
        $data = $request->all();
        $data['evaluation']= $request->evaluation;
        } else {
        $total = 
        $request->attendance_grade + 
        $request->hymns_grade + 
        $request->coptic_grade + 
        $request->theology_grade;

        $data = $request->all();
        $data['total'] = $total;
        }

         $student->update($data);

        return redirect()->route('admin.index')->with('success', 'تم إضافة النتيجة بنجاح.');
    }




    // نموذج صفحة Create
public function create()
{
    return view('admin.create'); // هنعمل view بسيط لإضافة طالب
}

// تخزين طالب جديد
public function store(Request $request)
{
    $data = $request->validate([
        'full_name' => 'required|string',
        'age' => 'required|integer',
        'academic_year' => 'required|string',
        'gender' => 'required|string',
        'deacon_rank' => 'nullable|string',
        'phone' => 'nullable|string',
        'attendance_grade' => 'nullable|numeric',
        'hymns_grade' => 'nullable|numeric',
        'coptic_grade' => 'nullable|numeric',
        'theology_grade' => 'nullable|numeric',
        'evaluation' => 'nullable|string',
    ]);

    if (str_contains($data['academic_year'], 'حضانة')) {
        $data['total'] = null;
    } else {
        $data['total'] = ($data['attendance_grade'] ?? 0) + ($data['hymns_grade'] ?? 0) + ($data['coptic_grade'] ?? 0) + ($data['theology_grade'] ?? 0);
    }

    Student::create($data);

    return redirect()->route('admin.index')->with('success', 'تم إنشاء الطالب بنجاح.');
}


public function destroy($id)
{
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect()->route('admin.index')->with('success', 'تم حذف الطالب بنجاح.');
}

    
}

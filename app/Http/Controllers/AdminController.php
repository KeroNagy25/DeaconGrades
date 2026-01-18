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
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();
        $students = Student::whereIn('academic_year', $years)->paginate(10);
        return view('admin.index', compact('students'));
        
    }
    public function search(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();
        $search = $request->input('search');
        $students = Student::whereIn('academic_year', $years) 
                            ->where(function($query) use ($search) {
                                $query->where('full_name', 'LIKE', "%{$search}%")
                                      ->orWhere('phone', 'LIKE', "%{$search}%");
                            })
                            ->paginate(10);

        return view('admin.index', compact('students'));

    }
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();

        $student = Student::whereIn('academic_year', $years)->findOrFail($id);

        return view('admin.edit', compact('student'));
    }
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $years = AdminYear::where('admin_id', $admin->id)->pluck('academic_year')->toArray();

        $student = Student::whereIn('academic_year', $years)->findOrFail($id);
        $total = 
        $request->attendance_grade + 
        $request->hymns_grade + 
        $request->coptic_grade + 
        $request->theology_grade;

        $data = $request->all();
        $data['total'] = $total;

         $student = Student::whereIn('academic_year', $years)->findOrFail($id)->update($data);

        return redirect()->route('admin.index')->with('success', 'تم تحديث بيانات الطالب بنجاح.');
    }
    
}

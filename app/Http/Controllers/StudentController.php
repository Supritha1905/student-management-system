<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; 

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $perPage = 5;
        $students = Student::latest()->paginate($perPage); // Fixed: "Student" not "student"
        
        if ($request->ajax()) {
            return view('partials.students_table', compact('students'));
        }
        
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'course' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('profile_photo');

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('uploads', 'public');
            $data['profile_photo'] = $path;
        }

        Student::create($data);

        return redirect()->route('dashboard')->with('success', 'Student added successfully.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'course' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('profile_photo');

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($student->profile_photo) {
                Storage::disk('public')->delete($student->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('uploads', 'public');
            $data['profile_photo'] = $path;
        }

        $student->update($data);

        return redirect()->route('dashboard')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        if ($student->profile_photo) {
            Storage::disk('public')->delete($student->profile_photo);
        }
        
        $student->delete();
        
        return redirect()->route('dashboard')->with('success', 'Student deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $perPage = 5;
        
        $students = Student::when($search, function($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('course', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate($perPage);
        
        return view('partials.students_table', compact('students'));
    }

    public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt'
    ]);

    $file = $request->file('csv_file');
    $path = $file->getRealPath();

    $handle = fopen($path, 'r');
    $header = fgetcsv($handle); // Skip header

    $imported = 0;
    while (($row = fgetcsv($handle)) !== false) {
        $email = trim($row[1]);

        // Check if email already exists
        if (!Student::where('email', $email)->exists()) {
            Student::create([
                'name' => trim($row[0]),
                'email' => $email,
                'phone' => trim($row[2]),
                'course' => trim($row[3]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $imported++;
        }
    }

    fclose($handle);

    return redirect()->route('dashboard')->with('success', "$imported students imported successfully.");
}
}
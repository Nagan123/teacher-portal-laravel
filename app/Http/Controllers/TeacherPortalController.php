<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class TeacherPortalController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('home', compact('students'));
    }

    public function addStudent(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subject_name' => 'required|string|max:255',
            'marks' => 'required|integer',
        ]);
    
        // Check if the student with the same name and subject already exists
        $student = Student::where('name', $validatedData['name'])
                          ->where('subject_name', $validatedData['subject_name'])
                          ->first();
    
        if ($student) {
            // Redirect back with an error message if the student already exists
            return redirect()->back()->withErrors(['error' => 'Student with the same name and subject already exists.']);
        } else {
            // Create a new student record if it does not exist
            Student::create($validatedData);
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Student added successfully.');
        }
    }
    

    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'subject_name' => 'required',
            'marks' => 'required|integer',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->back()->with('success', 'Student Updated successfully.');
    }

    public function deleteStudent($id)
    {
        Student::destroy($id);
        return redirect()->back()->with('danger', 'Student Deleted successfully.');
    }
}

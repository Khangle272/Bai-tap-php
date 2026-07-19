<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function indexDB()
    {
        $gender = request("gender");
        $query = \App\Models\Student::query()->orderBy('id', 'desc');

        if ($gender) {
            $query->where('gender', $gender);
        }

        $students = $query->paginate(5)->appends(compact('gender'));

        return view('students.index_db', compact('students', 'gender'));
    }

    public function combined()
    {
        $static = [
            [
                'name' => 'Nguyễn An',
                'age' => 19,
                'email' => 'an@huit.edu.vn',
                'gender' => 'male'
            ],
            [
                'name' => 'Trần Bình',
                'age' => 18,
                'email' => 'binh@huit.edu.vn',
                'gender' => 'male'
            ],
            [
                'name' => 'Lê Chi',
                'age' => 17,
                'email' => 'chi@huit.edu.vn',
                'gender' => 'female'
            ],
        ];

        $db = Student::orderBy('id', 'desc')->paginate(5);

        $source = request('source', 'db');

        return view('students.combined', compact('static', 'db', 'source'));
    }

    public function index()
    {
        $students = [
            [
                'name' => 'Nguyễn An',
                'age' => 19,
                'email' =>

                    'an@huit.edu.vn'
            ],

            [
                'name' => 'Trần Bình',
                'age' => 18,
                'email' =>

                    'binh@huit.edu.vn'
            ],

            [
                'name' => 'Lê Chi',
                'age' => 17,
                'email' =>

                    'chi@huit.edu.vn'
            ],

            [
                'name' => 'Phạm Dũng',
                'age' => 20,
                'email' =>

                    'dung@huit.edu.vn'
            ],

            [
                'name' => 'Đỗ Em',
                'age' => 21,
                'email' =>

                    'em@huit.edu.vn'
            ],
        ];

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:254',
            'email' => 'required|email|unique:students,email',
            'age' => 'nullable|integer|min:16',
            'gender' => 'nullable|in:male,female',
        ]);

        student::create($validated);

        return redirect('/students/db')->with('success', 'Tạo mới thành công');
    }
}

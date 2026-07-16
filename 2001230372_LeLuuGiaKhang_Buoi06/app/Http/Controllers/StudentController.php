<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
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
}

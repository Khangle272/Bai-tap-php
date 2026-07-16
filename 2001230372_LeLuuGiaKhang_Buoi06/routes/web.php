<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "Xin chao laravel 13";
});

Route::get("/time", function () {
    return now()->format("H:i:s d/m/Y");
});

Route::get("/sum/{a}/{b}", function ($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        return response("Tham so phai la so nguyen", 400);
    }
    return (int) $a + (int) $b;
});

Route::get("/students", [studentController::class, "index"]);

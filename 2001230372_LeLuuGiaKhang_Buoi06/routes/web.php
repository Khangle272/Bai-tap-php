<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "Xin chao Laravel 13";
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

Route::get("/students/db", [studentController::class, "indexDB"]);

Route::get("/students/combined", [studentController::class, "combined"]);

Route::get("/students/create", [studentController::class, "create"]);

Route::post("/students", [studentController::class, "store"]);

Route::get("/about", [AboutController::class, "index"]);
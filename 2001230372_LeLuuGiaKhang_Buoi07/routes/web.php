<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles/page/{page}', function ($page) {
    return "Trang bai viet so: " . (int) $page;
})->whereNumber('page')->name('articles.page');

Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug;
})->where("slug", "[a-z0-9]+");

Route::prefix('admin')->group(function () {
    Route::get('/articles', fn() => 'Quan tri vien bai viet')->name('admin.articles.index');
});

Route::resource('articles', ArticleController::class);
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = [
            [
                "id" => 1,
                "title" => "Gioi thieu laravel 13",
                "body" => "Noi dung A"
            ],
            [
                "id" => 2,
                "title" => "Blade Components",
                "body" => "Noi dung B"
            ]
        ];

        return view("articles.index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "body" => "required|string|min:10"
        ]);

        return redirect()->route('articles.index')->with('success', "Tao bai viet thanh cong");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return "Xem chi tiết bài viết ID: " . $article->id . "<br>Tiêu đề: " . $article->title;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = ['id' => $id, 'title' => "Tieu de mau", "body" => "Noi dung mau"];

        return view("articles.edit", compact("article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "body" => "required|string|min:10"
        ]);
        return redirect()->route("articles.index")->with("success", "Cap nhat bai viet #$id thanh cong");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route("articles.index")->with("success", "da xoa bai viet #$id thanh cong");
    }
}

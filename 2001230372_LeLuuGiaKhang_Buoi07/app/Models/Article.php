<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // 1. Tạo mảng dữ liệu giả lập (Mock data)
    protected static $mockData = [
        ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung A'],
        ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung B'],
    ];

    // 2. Tạm thời mock hàm findOrFail theo yêu cầu
    public static function mockFindOrFail($id)
    {
        $articleData = collect(self::$mockData)->firstWhere('id', $id);

        if (!$articleData) {
            abort(404); // Báo lỗi 404 nếu không tìm thấy bài viết
        }

        // Tạo một instance (đối tượng) của Model và nhét dữ liệu giả vào
        $article = new self();
        $article->forceFill($articleData);

        return $article;
    }

    // 3. Ghi đè hàm này để giả lập Implicit Route Model Binding khi chưa gắn DB
    public function resolveRouteBinding($value, $field = null)
    {
        return self::mockFindOrFail($value);
    }
}

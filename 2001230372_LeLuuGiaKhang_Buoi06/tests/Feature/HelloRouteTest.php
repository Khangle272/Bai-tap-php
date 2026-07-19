<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloRouteTest extends TestCase
{
    /**
     * Test route /hello
     */
    public function test_hello_route_returns_correct_content(): void
    {
        // 1. Gửi một request GET đến route '/hello'
        $response = $this->get('/hello');

        // 2. Kiểm tra xem mã trạng thái trả về có phải là 200 (OK) không
        $response->assertStatus(200);

        // 3. Kiểm tra xem nội dung trả về có chứa chuỗi "Laravel 12" không
        $response->assertSee('Laravel 13');
    }
}
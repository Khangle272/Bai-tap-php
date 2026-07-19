@extends('layouts.app')
@section('title', 'Thêm sinh viên mới')

@section('content')
    <h2>Thêm sinh viên mới</h2>

    <form method="POST" action="{{ url('/students') }}">
        <!-- Directive CSRF bắt buộc trong Laravel -->
        @csrf

        <div style="margin-bottom: 15px">
            <label>Họ tên:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            <!-- Hiển thị lỗi cho trường name -->
            @error('name')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px">
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px">
            <label>Tuổi:</label><br>
            <input type="number" name="age" value="{{ old('age') }}">
            @error('age')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px">
            <label>Giới tính:</label><br>
            <select name="gender">
                <option value="">-- Chọn giới tính --</option>
                <option value="male" @selected(old('gender') == 'male')>Nam</option>
                <option value="female" @selected(old('gender') == 'female')>Nữ</option>
            </select>
            @error('gender')
                <div style="color: red; font-size: 13px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Lưu Sinh Viên</button>
    </form>
@endsection
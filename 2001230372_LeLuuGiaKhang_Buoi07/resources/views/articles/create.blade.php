@extends('layouts.app')
@section('title', 'Tao bai viet')

@push('styles')
    <style>
        .form-wrapper {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
    </style>
@endpush

@section('content')
    <h2>Tao bai viet</h2>

    <x-alert type="warning" title="Luu y">Du lieu mo phong</x-alert>

    <form action="{{ route('articles.store') }}" method="post">
        @csrf

        <x-input name="title" label="Tieu de" />
        <label style="display:block;margin:8px 0 4px">Nội dung</label>
        <textarea name="body" rows="6"
            style="width:100%;padding:8px;border:1px solid #e5e7eb;border-radius:6px">{{ old('body') }}</textarea>
        @error('body')
            <div style="color:#991B1B;margin-top:4px">{{ $message }}</div>
        @enderror

        <button type="submit" style="margin-top:10px">Lưu</button>
    </form>

@endsection
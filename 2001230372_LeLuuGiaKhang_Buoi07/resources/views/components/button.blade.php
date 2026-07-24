@props(['variant' => 'primary'])

@php
    // Xác định màu sắc dựa trên biến thể (variant)
    $bgColor = $variant === 'danger' ? '#EF4444' : '#3B82F6'; // Đỏ cho danger, Xanh cho primary
    $hoverColor = $variant === 'danger' ? '#DC2626' : '#2563EB';
@endphp

<button {{ $attributes->merge(['style' => "background-color: {$bgColor}; color: white; padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; margin-top: 10px;"]) }}>
    {{ $slot }}
</button>
@props(['title' => ''])

<div
    style="border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); background-color: #fff;">
    <!-- Phần Tiêu đề -->
    @if($title)
        <h3 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px;">
            {{ $title }}
        </h3>
    @endif

    <!-- Phần Nội dung (Slot) -->
    <div class="card-content">
        {{ $slot }}
    </div>
</div>
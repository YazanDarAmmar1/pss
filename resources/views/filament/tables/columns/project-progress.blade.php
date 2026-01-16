@php
    $value = (int) $getState();
@endphp

<div style="width: 100%">
    <div
        style="
            background:#e5e7eb;
            height:18px;
            border-radius:6px;
            position: relative;
            overflow: hidden;
        "
    >
        <div
            style="
                width: {{ $value }}%;
                height: 100%;
                background: {{ $value < 30 ? '#dc2626' : ($value < 70 ? '#f59e0b' : '#16a34a') }};
                transition: width .3s ease;
            "
        ></div>

        <div
            style="
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 600;
                color: {{ $value < 30 ? '#ffffff' : '#1f2937' }};
            "
        >
            {{ $value }}%
        </div>
    </div>
</div>


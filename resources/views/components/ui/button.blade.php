@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-sm focus:ring-blue-500',
        'secondary' => 'bg-gray-100 hover:bg-gray-200 text-gray-900 focus:ring-gray-500',
        'outline' => 'border-2 border-gray-300 hover:border-gray-400 text-gray-700 bg-white focus:ring-gray-500',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white shadow-sm focus:ring-red-500',
        'ghost' => 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:ring-gray-500',
    ];
    
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    
    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif

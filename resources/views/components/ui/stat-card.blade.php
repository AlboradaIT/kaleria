@props([
    'title',
    'value',
    'color' => 'blue',
    'icon',
    'href' => null,
])

@php
    $colors = [
        'blue' => 'bg-blue-500',
        'green' => 'bg-green-500',
        'yellow' => 'bg-orange-500',
        'red' => 'bg-red-500',
        'purple' => 'bg-purple-500',
        'teal' => 'bg-teal-500',
    ];
    
    $bgColor = $colors[$color];

    $tag = $href ? 'a' : 'div';

@endphp


<{{ $tag }}
    @if ( $href )
        href="{{ $href }}"
    @endif

    @class([
        'cursor-pointer transform hover:scale-105' => $href,
        'relative',
        $bgColor,
        'p-2',
        'transition-all',
        'duration-300',
        'hover:shadow-lg',
        'overflow-hidden',
        'group',
        'size-24',
        'rounded-sm' 
    ])
/>
    <!-- Background Icon - Bottom Right, Partially Cut Off -->
    <div 
        class="
            absolute 
            -bottom-2 
            -right-2
            w-16 
            h-16
            text-white
            opacity-20
        "
    >
        <x-dynamic-component :component="$icon" class="w-full h-full" />
    </div>
    
    <!-- Content -->
    <div class="relative z-10">
        <!-- Title at top -->
        <p 
            class="
                text-sm 
                font-medium 
                text-white
                opacity-90
                mb-3
            "
        >
            {{ $title }}
        </p>
        
        <!-- Big white number -->
        <p 
            class="
                text-4xl 
                font-bold 
                text-white
                leading-none
            "
        >
            {{ $value }}
        </p>
    </div>
</{{ $tag }}>
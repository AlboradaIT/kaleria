@props([
    'title' => null,
    'ui' => [],
])

@php
    $headerClass = $ui['header'] ?? '';
    $bodyClass = $ui['body'] ?? '';
@endphp

<div 
    class="
        bg-white
        lg:rounded-lg
        lg:border
        lg:border-gray-200
        shadow-sm
        lg:shadow-none
        overflow-hidden
    "
    {{ $attributes }}
>
    <!-- Header Section -->
    @if(isset($header) || $title)
        <div 
            @class([
                'p-4',
                $headerClass
            ])
        >
            @if(isset($header))
                {{ $header }}
            @else
                <h3 
                    class="
                        text-lg
                        font-semibold
                        text-gray-900
                    "
                >
                    {{ $title }}
                </h3>
            @endif
        </div>
    @endif

    <!-- Body Section -->
    <div 
        @class([
            'px-4',
            'pb-4',
            $bodyClass
        ])
    >
        @if(isset($body))
            {{ $body }}
        @else
            {{ $slot }}
        @endif
    </div>
</div>

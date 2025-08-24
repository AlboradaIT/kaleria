@props([
    'href' => '#',
    'icon',
    'label',
    'active' => false,
])

<a 
    href="{{ $href }}"
    @class([
        'flex',
        'items-center',
        'px-3',
        'py-2.5',
        'rounded-lg',
        'transition-colors',
        'group',
        'bg-blue-50 text-blue-700' => $active,
        'text-gray-700 hover:bg-blue-50 hover:text-blue-700' => !$active,
    ])
    :class="{
        'justify-center': !$store.sidebar.expanded && window.innerWidth >= 1024,
        'justify-start': $store.sidebar.expanded || window.innerWidth < 1024
    }"
>
    <div class="w-5 h-5 flex-shrink-0">
        {{ $icon }}
    </div>
    <span 
        class="
            ml-3 
            transition-all 
            duration-200
            overflow-hidden
            whitespace-nowrap
        "
        x-show="$store.sidebar.expanded || window.innerWidth < 1024"
        x-transition:enter="transition-all duration-200"
        x-transition:enter-start="opacity-0 w-0"
        x-transition:enter-end="opacity-100 w-auto"
        x-transition:leave="transition-all duration-200"
        x-transition:leave-start="opacity-100 w-auto"
        x-transition:leave-end="opacity-0 w-0"
    >
        {{ $label }}
    </span>
</a>

@props([
    'links' => []
])

<!-- Navigation -->
<nav class="mt-6 px-3 space-y-2 flex-1">
    @foreach($links as $link)
        <x-sidebar.nav-item
            href="{{ $link['href'] }}"
            label="{{ $link['label'] }}"
            :active="$link['active']"
        >
            <x-slot:icon>
                <x-dynamic-component :component="$link['icon']" class="w-5 h-5" />
            </x-slot:icon>
        </x-sidebar.nav-item>
    @endforeach
</nav>

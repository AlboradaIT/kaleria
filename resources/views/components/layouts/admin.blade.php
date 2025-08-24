<x-layouts.app>
<div 
    class="min-h-screen"
    x-data
    x-init="
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                $store.sidebar.open = true;
            } else {
                $store.sidebar.open = false;
                $store.sidebar.expanded = true;
            }
        });
        
        if (window.innerWidth >= 1024) {
            $store.sidebar.open = true;
        }
    "
>
    <!-- Sidebar -->
    <livewire:components.sidebar />
    
    <!-- Main Content -->
    <div 
        class="
            transition-all 
            duration-300 
            ease-in-out
            ml-0
        "
        x-cloak
        :class="{
            'ml-20': $store.sidebar.open && !$store.sidebar.expanded && window.innerWidth >= 1024,
            'ml-72': $store.sidebar.open && $store.sidebar.expanded && window.innerWidth >= 1024,
            'ml-0': !$store.sidebar.open || window.innerWidth < 1024
        }"
    >
        <!-- Header -->
        <livewire:components.header :title="$title ?? 'Dashboard'" :subtitle="$subtitle ?? ''" />
        
        <!-- Page Content -->
        <main class="pt-16 px-0 sm:px-6 pb-6">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
    
    <!-- Mobile sidebar overlay -->
    <div 
        x-show="$store.sidebar.open && window.innerWidth < 1024"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="$store.sidebar.open = false"
        class="fixed inset-0 bg-gray-900 bg-opacity-75 z-40 lg:hidden"
        style="display: none;"
    ></div>
</div>
</x-layouts.app>
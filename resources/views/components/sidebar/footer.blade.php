<!-- Bottom Section -->
<div class="absolute bottom-0 left-0 right-0 p-3 space-y-2 border-t border-gray-100">
    <!-- Settings -->
    <x-sidebar.nav-item
        href="#"
        label="{{ __('Settings') }}"
    >
        <x-slot:icon>
            <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
        </x-slot:icon>
    </x-sidebar.nav-item>
    
    <!-- Toggle Button - Desktop Only -->
    <button 
        @click="$store.sidebar.expanded = !$store.sidebar.expanded; $store.sidebar.userSet = true;"
        class="
            hidden
            lg:flex
            w-10
            h-10
            items-center 
            justify-center
            rounded-full
            text-gray-700 
            hover:bg-blue-50 
            hover:text-blue-700
            transition-colors 
            group
            mx-auto
        "
        :title="$store.sidebar.expanded ? '{{ __('Collapse') }}' : '{{ __('Expand') }}'"
    >
        <x-heroicon-o-chevron-double-right 
            class="w-5 h-5 transition-transform duration-200" 
            x-show="!$store.sidebar.expanded"
        />
        <x-heroicon-o-chevron-double-left 
            class="w-5 h-5 transition-transform duration-200" 
            x-show="$store.sidebar.expanded"
        />
    </button>
</div>

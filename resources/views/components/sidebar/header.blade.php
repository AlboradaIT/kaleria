<!-- Header -->
<div 
    class="
        flex 
        items-center 
        p-4 
        border-b 
        border-gray-100
        h-16
    "
    :class="{
        'justify-center': !$store.sidebar.expanded && window.innerWidth >= 1024,
        'justify-start': $store.sidebar.expanded || window.innerWidth < 1024
    }"
>
    <div 
        class="flex items-center"
        :class="{
            'space-x-0': !$store.sidebar.expanded && window.innerWidth >= 1024,
            'space-x-3': $store.sidebar.expanded || window.innerWidth < 1024
        }"
    >
        <!-- Logo -->
        <div 
            class="
                w-10 
                h-10 
                bg-gradient-to-r 
                from-blue-500 
                to-purple-600 
                rounded-xl 
                flex 
                items-center 
                justify-center
                flex-shrink-0
            "
        >
            <span class="text-white font-bold text-lg">K</span>
        </div>
        
        <!-- Brand Text -->
        <div 
            class="
                transition-all 
                duration-200
                overflow-hidden
            "
            x-show="$store.sidebar.expanded || window.innerWidth < 1024"
            x-transition:enter="transition-all duration-200"
            x-transition:enter-start="opacity-0 w-0"
            x-transition:enter-end="opacity-100 w-auto"
            x-transition:leave="transition-all duration-200"
            x-transition:leave-start="opacity-100 w-auto"
            x-transition:leave-end="opacity-0 w-0"
        >
            <h1 class="text-lg font-bold text-gray-900 whitespace-nowrap">Kaleria</h1>
            <p class="text-xs text-gray-500 whitespace-nowrap">Cleaning Management</p>
        </div>
    </div>
</div>

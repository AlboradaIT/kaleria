<header 
    class="
        fixed 
        top-0 
        right-0 
        left-0
        lg:left-20
        z-40 
        bg-white/95 
        backdrop-blur-sm 
        border-b 
        border-gray-200/50 
        transition-all 
        duration-300
        h-16
    "
    :class="{
        'lg:left-72': $store.sidebar.expanded && $store.sidebar.open && window.innerWidth >= 1024,
        'lg:left-20': !$store.sidebar.expanded && $store.sidebar.open && window.innerWidth >= 1024,
        'lg:left-0': !$store.sidebar.open && window.innerWidth >= 1024,
        'left-0': window.innerWidth < 1024
    }"
    x-data="{ 
        scrolled: false,
        toggleSidebar() {
            $store.sidebar.toggle();
        }
    }"
    @scroll.window="scrolled = window.pageYOffset > 0"
    :class="{ 'shadow-sm': scrolled }"
>
    <!-- Mobile Layout -->
    <div class="flex items-center justify-between px-4 h-16 lg:hidden">
        <!-- Mobile menu button -->
        <button 
            @click="toggleSidebar()"
            class="
                p-2 
                rounded-lg 
                hover:bg-gray-100 
                transition-colors
            "
        >
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <!-- Title -->
        <h1 class="text-lg font-semibold text-gray-900">{{ $title }}</h1>
        
        <!-- Right section -->
        <div class="flex items-center space-x-2">
            <!-- Notifications -->
            <button 
                class="
                    relative 
                    p-2 
                    rounded-lg 
                    hover:bg-gray-100 
                    transition-colors
                "
            >
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM19 5l-5 5m0 0L9 5m5 5v14"></path>
                </svg>
                <span 
                    class="
                        absolute 
                        -top-1 
                        -right-1 
                        w-4 
                        h-4 
                        bg-teal-500 
                        rounded-full 
                        text-xs 
                        text-white 
                        flex 
                        items-center 
                        justify-center
                        text-xs
                        font-medium
                    "
                >
                    3
                </span>
            </button>
            
            <!-- User Profile -->
            <div class="relative" x-data="{ open: false }">
                <button 
                    @click="open = !open"
                    class="
                        flex 
                        items-center 
                        space-x-2 
                        p-1 
                        rounded-lg 
                        hover:bg-gray-100 
                        transition-colors
                    "
                >
                    <div 
                        class="
                            w-8 
                            h-8 
                            bg-gradient-to-r 
                            from-blue-500 
                            to-purple-600 
                            rounded-lg 
                            flex 
                            items-center 
                            justify-center
                        "
                    >
                        <span class="text-white text-sm font-medium">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    </div>
                </button>
                
                <!-- Mobile Dropdown -->
                <div 
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="
                        absolute 
                        right-0 
                        mt-2 
                        w-48 
                        bg-white 
                        rounded-lg 
                        shadow-lg 
                        border 
                        border-gray-200 
                        py-1 
                        z-50
                    "
                    style="display: none;"
                >
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                    <hr class="my-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Desktop Layout -->
    <div class="hidden lg:flex items-center h-16">
        <!-- Left section with golden ratio (61.8%) -->
        <div class="flex-1" style="flex: 1.618;">
            <div class="flex items-center justify-between px-6">
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">{{ $title }}</h1>
                    @if($subtitle)
                        <p class="text-sm text-gray-600">{{ $subtitle }}</p>
                    @endif
                </div>
                
                <!-- Search -->
                <div class="relative">
                    <input 
                        type="text" 
                        placeholder="Search..."
                        class="
                            w-64 
                            pl-10 
                            pr-4 
                            py-2 
                            border 
                            border-gray-200 
                            rounded-lg 
                            focus:outline-none 
                            focus:ring-2 
                            focus:ring-blue-500 
                            focus:border-transparent 
                            bg-white/70 
                            backdrop-blur-sm
                            text-sm
                        "
                    >
                    <svg 
                        class="
                            absolute 
                            left-3 
                            top-1/2 
                            transform 
                            -translate-y-1/2 
                            w-4 
                            h-4 
                            text-gray-400
                        " 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Separator -->
        <div class="w-px h-8 bg-gray-200"></div>
        
        <!-- Right section (38.2%) -->
        <div class="flex-1 px-6" style="flex: 1;">
            <div class="flex items-center justify-end space-x-4">
                <!-- Notifications -->
                <button 
                    class="
                        relative 
                        p-2 
                        rounded-lg 
                        hover:bg-gray-100 
                        transition-colors
                    "
                >
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM19 5l-5 5m0 0L9 5m5 5v14"></path>
                    </svg>
                    <span 
                        class="
                            absolute 
                            -top-1 
                            -right-1 
                            w-4 
                            h-4 
                            bg-teal-500 
                            rounded-full 
                            text-xs 
                            text-white 
                            flex 
                            items-center 
                            justify-center
                            font-medium
                        "
                    >
                        3
                    </span>
                </button>
                
                <!-- User Profile -->
                <div class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open"
                        class="
                            flex 
                            items-center 
                            space-x-3 
                            p-2 
                            rounded-lg 
                            hover:bg-gray-100 
                            transition-colors
                        "
                    >
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <div 
                            class="
                                w-8 
                                h-8 
                                bg-gradient-to-r 
                                from-blue-500 
                                to-purple-600 
                                rounded-lg 
                                flex 
                                items-center 
                                justify-center
                            "
                        >
                            <span class="text-white text-sm font-medium">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Desktop Dropdown -->
                    <div 
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="
                            absolute 
                            right-0 
                            mt-2 
                            w-48 
                            bg-white 
                            rounded-lg 
                            shadow-lg 
                            border 
                            border-gray-200 
                            py-1 
                            z-50
                        "
                        style="display: none;"
                    >
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        <hr class="my-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

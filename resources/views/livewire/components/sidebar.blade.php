<div 
    class="
        fixed 
        left-0 
        top-0 
        h-full 
        transition-all 
        duration-300 
        ease-in-out 
        z-50 
        bg-white
        shadow-lg
        border-r 
        border-gray-200
    "
    x-cloak
    x-data="{
        get sidebarOpen() { return $store.sidebar.open },
        get sidebarExpanded() { return $store.sidebar.expanded },
        get isDesktop() { return window.innerWidth >= 1024 }
    }"
    :class="{
        // Desktop behavior
        'w-72': sidebarExpanded && isDesktop,
        'w-20': !sidebarExpanded && isDesktop,
        'translate-x-0': isDesktop,
        
        // Mobile behavior  
        'w-72': !isDesktop && sidebarOpen,
        'translate-x-0': !isDesktop && sidebarOpen,
        '-translate-x-full': !isDesktop && !sidebarOpen
    }"
>
    <x-sidebar.header />
    <x-sidebar.navigation :links="$this->navigationLinks" />
    <x-sidebar.footer />
</div>
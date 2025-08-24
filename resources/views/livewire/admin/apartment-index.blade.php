<div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Apartments</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Manage apartment properties and their details
                    </p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <button
                        type="button"
                        class="
                            inline-flex 
                            items-center 
                            px-4 
                            py-2 
                            border 
                            border-transparent 
                            text-sm 
                            font-medium 
                            rounded-lg 
                            text-white 
                            bg-blue-600 
                            hover:bg-blue-700 
                            focus:outline-none 
                            focus:ring-2 
                            focus:ring-offset-2 
                            focus:ring-blue-500
                        "
                        disabled
                    >
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Apartment (Demo)
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Search apartments
                    </label>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        class="
                            block 
                            w-full 
                            px-3 
                            py-2 
                            border 
                            border-gray-300 
                            rounded-lg 
                            text-gray-900 
                            placeholder-gray-500 
                            focus:outline-none 
                            focus:ring-2 
                            focus:ring-blue-500 
                            focus:border-blue-500
                        "
                        placeholder="Search by name, address, or city..."
                    />
                </div>
                <div class="flex items-end">
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            wire:model.live="showInactive"
                            class="
                                rounded 
                                border-gray-300 
                                text-blue-600 
                                shadow-sm 
                                focus:border-blue-300 
                                focus:ring 
                                focus:ring-offset-0 
                                focus:ring-blue-200 
                                focus:ring-opacity-50
                            "
                        />
                        <span class="ml-2 text-sm text-gray-700">Show inactive</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Apartments Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($this->apartments as $apartment)
                <div
                    class="
                        bg-white 
                        rounded-lg 
                        shadow 
                        border 
                        border-gray-200 
                        hover:shadow-md 
                        transition-shadow 
                        duration-200
                        @if(!$apartment->is_active) opacity-60 @endif
                    "
                >
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $apartment->name }}
                            </h3>
                            <div class="flex items-center space-x-2">
                                @if($apartment->is_active)
                                    <span
                                        class="
                                            inline-flex 
                                            items-center 
                                            px-2.5 
                                            py-0.5 
                                            rounded-full 
                                            text-xs 
                                            font-medium 
                                            bg-green-100 
                                            text-green-800
                                        "
                                    >
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="
                                            inline-flex 
                                            items-center 
                                            px-2.5 
                                            py-0.5 
                                            rounded-full 
                                            text-xs 
                                            font-medium 
                                            bg-gray-100 
                                            text-gray-800
                                        "
                                    >
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            @if($apartment->address)
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $apartment->address }}
                                    @if($apartment->city), {{ $apartment->city }}@endif
                                </p>
                            @endif
                            <div class="flex items-center justify-between">
                                @if($apartment->max_guests)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        {{ $apartment->max_guests }} guests
                                    </span>
                                @endif
                                @if($apartment->bedrooms)
                                    <span>{{ $apartment->bedrooms }} bed</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>{{ $apartment->work_orders_count }} work orders</span>
                            <span>{{ $apartment->bookings_count }} bookings</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <button
                                wire:click="toggleStatus({{ $apartment->id }})"
                                class="
                                    text-sm 
                                    @if($apartment->is_active) text-red-600 hover:text-red-700 @else text-green-600 hover:text-green-700 @endif
                                    font-medium
                                "
                            >
                                @if($apartment->is_active) Deactivate @else Activate @endif
                            </button>
                            <div class="flex items-center space-x-3">
                                <button
                                    wire:click="$dispatch('openModal', { component: 'admin.apartment-form', arguments: { apartment: {{ $apartment->id }} } })"
                                    class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                                >
                                    Edit
                                </button>
                                <button
                                    wire:click="deleteApartment({{ $apartment->id }})"
                                    wire:confirm="Are you sure you want to delete this apartment?"
                                    class="text-sm text-red-600 hover:text-red-700 font-medium"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div
                        class="
                            bg-white 
                            rounded-lg 
                            shadow 
                            border 
                            border-gray-200 
                            p-12 
                            text-center
                        "
                    >
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No apartments found</h3>
                        <p class="text-gray-500 mb-6">Get started by adding your first apartment.</p>
                        <button
                            wire:click="$dispatch('openModal', { component: 'admin.apartment-form' })"
                            class="
                                inline-flex 
                                items-center 
                                px-4 
                                py-2 
                                border 
                                border-transparent 
                                text-sm 
                                font-medium 
                                rounded-lg 
                                text-white 
                                bg-blue-600 
                                hover:bg-blue-700
                            "
                        >
                            Add Your First Apartment
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($this->apartments->hasPages())
            <div class="mt-8">
                {{ $this->apartments->links() }}
            </div>
        @endif
    </div>
</div>

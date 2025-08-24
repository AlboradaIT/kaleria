<div>
    <form wire:submit.prevent="save">
        <div class="bg-white px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $this->getModalTitle() }}
            </h3>
        </div>

        <div class="bg-white px-6 py-4 max-h-96 overflow-y-auto">
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Apartment Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="name"
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
                            @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                        "
                        placeholder="e.g., Cozy Downtown Apartment"
                    />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        wire:model="address"
                        rows="2"
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
                            @error('address') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                        "
                        placeholder="Street address, apartment number, etc."
                    ></textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City, Postal Code, Country -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            City
                        </label>
                        <input
                            type="text"
                            wire:model="city"
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
                                @error('city') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                            "
                            placeholder="City"
                        />
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Postal Code
                        </label>
                        <input
                            type="text"
                            wire:model="postal_code"
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
                                @error('postal_code') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                            "
                            placeholder="12345"
                        />
                        @error('postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Country
                        </label>
                        <input
                            type="text"
                            wire:model="country"
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
                                @error('country') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                            "
                            placeholder="Country"
                        />
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Apartment Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Max Guests
                        </label>
                        <input
                            type="number"
                            wire:model="max_guests"
                            min="1"
                            max="20"
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
                                @error('max_guests') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                            "
                            placeholder="4"
                        />
                        @error('max_guests')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Bedrooms
                        </label>
                        <input
                            type="number"
                            wire:model="bedrooms"
                            min="1"
                            max="10"
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
                                @error('bedrooms') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                            "
                            placeholder="2"
                        />
                        @error('bedrooms')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Bathrooms
                        </label>
                        <input
                            type="number"
                            wire:model="bathrooms"
                            min="1"
                            max="10"
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
                                @error('bathrooms') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                            "
                            placeholder="1"
                        />
                        @error('bathrooms')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- External ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        External ID (Smoobu)
                    </label>
                    <input
                        type="text"
                        wire:model="external_id"
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
                            @error('external_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                        "
                        placeholder="Smoobu apartment ID"
                    />
                    @error('external_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            wire:model="is_active"
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
                        <span class="ml-2 text-sm font-medium text-gray-700">
                            Active apartment
                        </span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500">
                        Inactive apartments won't receive new work orders
                    </p>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea
                        wire:model="description"
                        rows="3"
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
                            @error('description') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror
                        "
                        placeholder="Additional details about this apartment..."
                    ></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3 border-t border-gray-200">
            <button
                type="button"
                wire:click="closeModal"
                class="
                    px-4 
                    py-2 
                    text-sm 
                    font-medium 
                    text-gray-700 
                    bg-white 
                    border 
                    border-gray-300 
                    rounded-lg 
                    hover:bg-gray-50 
                    focus:outline-none 
                    focus:ring-2 
                    focus:ring-offset-2 
                    focus:ring-blue-500
                "
            >
                Cancel
            </button>
            <button
                type="submit"
                class="
                    px-4 
                    py-2 
                    text-sm 
                    font-medium 
                    text-white 
                    bg-blue-600 
                    border 
                    border-transparent 
                    rounded-lg 
                    hover:bg-blue-700 
                    focus:outline-none 
                    focus:ring-2 
                    focus:ring-offset-2 
                    focus:ring-blue-500
                    disabled:opacity-50 
                    disabled:cursor-not-allowed
                "
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>
                    {{ $isEditing ? 'Update' : 'Create' }} Apartment
                </span>
                <span wire:loading>
                    Saving...
                </span>
            </button>
        </div>
    </form>
</div>

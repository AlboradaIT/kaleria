<div>
    <div 
        class="
            max-w-7xl 
            mx-auto 
            px-4 
            sm:px-6 
            lg:px-8
        "
    >
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Rates</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Manage cleaning rates for apartments and workers
                    </p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <button
                        wire:click="openCreateForm"
                        class="
                            inline-flex 
                            items-center 
                            px-4 
                            py-2 
                            border 
                            border-transparent 
                            rounded-md 
                            shadow-sm 
                            text-sm 
                            font-medium 
                            text-white 
                            bg-blue-600 
                            hover:bg-blue-700 
                            focus:outline-none 
                            focus:ring-2 
                            focus:ring-offset-2 
                            focus:ring-blue-500
                        "
                    >
                        Add Rate
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div 
            class="
                bg-white 
                rounded-lg 
                shadow 
                p-6 
                mb-6
            "
        >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Search
                    </label>
                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Search by apartment or worker name..."
                        class="
                            w-full 
                            rounded-md 
                            border-gray-300 
                            shadow-sm 
                            focus:border-blue-500 
                            focus:ring-blue-500
                        "
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Apartment
                    </label>
                    <select
                        wire:model.live="selectedApartment"
                        class="
                            w-full 
                            rounded-md 
                            border-gray-300 
                            shadow-sm 
                            focus:border-blue-500 
                            focus:ring-blue-500
                        "
                    >
                        <option value="">All Apartments</option>
                        @foreach($this->apartments as $apartment)
                            <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Worker
                    </label>
                    <select
                        wire:model.live="selectedWorker"
                        class="
                            w-full 
                            rounded-md 
                            border-gray-300 
                            shadow-sm 
                            focus:border-blue-500 
                            focus:ring-blue-500
                        "
                    >
                        <option value="">All Workers</option>
                        @foreach($this->workers as $worker)
                            <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Rates Table -->
        <div 
            class="
                bg-white 
                rounded-lg 
                shadow 
                overflow-hidden
            "
        >
            @if($this->rates->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Apartment
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Worker
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rate
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($this->rates as $rate)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $rate->apartment->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $rate->apartment->external_id ?? 'No ID' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $rate->worker->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $rate->worker->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($rate->amount, 2) }} {{ $rate->currency }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $rate->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button
                                        wire:click="editRate({{ $rate->id }})"
                                        class="text-blue-600 hover:text-blue-700 mr-3"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        wire:click="deleteRate({{ $rate->id }})"
                                        wire:confirm="Are you sure you want to delete this rate?"
                                        class="text-red-600 hover:text-red-700"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4">
                    {{ $this->rates->links() }}
                </div>
            @else
            <div 
                class="
                    p-12 
                    text-center
                "
            >
                <svg 
                    class="
                        mx-auto 
                        h-12 
                        w-12 
                        text-gray-400
                    " 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" 
                    />
                </svg>
                <h3 
                    class="
                        mt-2 
                        text-sm 
                        font-medium 
                        text-gray-900
                    "
                >
                    No rates found
                </h3>
                <p 
                    class="
                        mt-1 
                        text-sm 
                        text-gray-500
                    "
                >
                    Get started by adding rates for your workers and apartments.
                </p>
                <div class="mt-6">
                    <button
                        wire:click="openCreateForm"
                        type="button"
                        class="
                            inline-flex 
                            items-center 
                            px-4 
                            py-2 
                            border 
                            border-transparent 
                            shadow-sm 
                            text-sm 
                            font-medium 
                            rounded-md 
                            text-white 
                            bg-blue-600 
                            hover:bg-blue-700 
                            focus:outline-none 
                            focus:ring-2 
                            focus:ring-offset-2 
                            focus:ring-blue-500
                        "
                    >
                        Add First Rate
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Rate Form Modal -->
    @if($showForm)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form wire:submit.prevent="saveRate">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            {{ $editingRateId ? 'Edit Rate' : 'Add Rate' }}
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Apartment *
                                </label>
                                <select
                                    wire:model="apartmentId"
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                                    <option value="">Select Apartment</option>
                                    @foreach($this->apartments as $apartment)
                                        <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
                                    @endforeach
                                </select>
                                @error('apartmentId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Worker *
                                </label>
                                <select
                                    wire:model="workerId"
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                                    <option value="">Select Worker</option>
                                    @foreach($this->workers as $worker)
                                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                    @endforeach
                                </select>
                                @error('workerId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Amount *
                                    </label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        wire:model="rateAmount"
                                        required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="0.00"
                                    >
                                    @error('rateAmount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Currency
                                    </label>
                                    <select
                                        wire:model="currency"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    >
                                        <option value="EUR">EUR</option>
                                        <option value="USD">USD</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            {{ $editingRateId ? 'Update' : 'Save' }}
                        </button>
                        <button
                            type="button"
                            wire:click="$set('showForm', false)"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

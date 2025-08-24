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
        <div class="mb-8">
            <h1 
                class="
                    text-2xl 
                    font-bold 
                    text-gray-900
                "
            >
                Work Orders
                @if($filter)
                    <span 
                        class="
                            text-lg 
                            font-normal 
                            text-gray-500
                        "
                    >
                        - {{ ucfirst($filter) }}
                    </span>
                @endif
            </h1>
        </div>

        <div 
            class="
                bg-white 
                rounded-lg 
                shadow
            "
        >
            @if($this->workOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Apartment
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Assigned To
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Scheduled
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($this->workOrders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $order->apartment->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'assigned') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->assignedTo?->name ?? 'Unassigned' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->scheduled_start->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4">
                    {{ $this->workOrders->links() }}
                </div>
            @else
            <div 
                class="
                    p-6 
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
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" 
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
                    No work orders
                </h3>
                <p 
                    class="
                        mt-1 
                        text-sm 
                        text-gray-500
                    "
                >
                    Get started by creating a new work order.
                </p>
                <div class="mt-6">
                    <button
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
                        Create Work Order
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

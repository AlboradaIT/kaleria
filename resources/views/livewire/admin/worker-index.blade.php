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
                Workers
            </h1>
        </div>

        <div 
            class="
                bg-white 
                rounded-lg 
                shadow
            "
        >
            @if($this->workers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Work Orders
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Joined
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($this->workers as $worker)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $worker->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $worker->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $worker->work_orders_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $worker->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4">
                    {{ $this->workers->links() }}
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
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" 
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
                    No workers
                </h3>
                <p 
                    class="
                        mt-1 
                        text-sm 
                        text-gray-500
                    "
                >
                    Get started by adding workers to your team.
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
                        Add Worker
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

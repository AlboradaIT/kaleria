<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <x-ui.card
        :title="__('Panel de Estadísticas')"
        :ui="['body' => 'grid grid-cols-2 gap-4']">
        <x-ui.stat-card
            title="Total Apartamentos"
            :value="$stats['total_apartments']"
            icon="heroicon-o-building-office"
            color="blue"
            href="#" />

        <x-ui.stat-card
            title="Órdenes Pendientes"
            :value="$stats['pending_orders']"
            icon="heroicon-o-clock"
            color="yellow"
            href="#" />

        <x-ui.stat-card
            title="Trabajadores Activos"
            :value="$stats['active_workers']"
            icon="heroicon-o-users"
            color="green"
            href="#" />

        <x-ui.stat-card
            title="Completadas Hoy"
            :value="$stats['completed_today']"
            icon="heroicon-o-check-circle"
            color="purple"
            href="#" />
    </x-ui.card>



    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4 mb-8">
        <x-ui.button
            variant="primary"
            size="lg"
            class="flex items-center space-x-2">
            <x-heroicon-o-plus class="w-5 h-5" />
            <span>Nueva Orden de Trabajo</span>
        </x-ui.button>

        <x-ui.button
            variant="secondary"
            size="lg"
            class="flex items-center space-x-2">
            <x-heroicon-o-eye class="w-5 h-5" />
            <span>Ver Todas las Órdenes</span>
        </x-ui.button>

        <x-ui.button
            variant="outline"
            size="lg"
            class="flex items-center space-x-2">
            <x-heroicon-o-user-plus class="w-5 h-5" />
            <span>Agregar Trabajador</span>
        </x-ui.button>
    </div>

    <!-- Recent Orders Table -->
    <x-ui.card title="Órdenes Recientes">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Apartamento
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trabajador
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Programada
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recent_orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $order->apartment->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->assignedTo?->name ?? 'Sin asignar' }}
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
                            {{ $order->scheduled_start->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                            No hay órdenes de trabajo registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.card>
</div>
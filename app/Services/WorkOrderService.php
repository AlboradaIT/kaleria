<?php

namespace App\Services;

use App\Models\WorkOrder;
use App\Models\Apartment;
use App\Models\User;
use App\Events\WorkOrderCreated;
use App\Events\WorkOrderAssigned;
use App\Events\WorkOrderCompleted;
use App\Events\WorkOrderRejected;
use Illuminate\Support\Facades\Event;

class WorkOrderService
{
    private const STATUS_TRANSITIONS = [
        'pending' => ['confirmed', 'cancelled'],
        'confirmed' => ['accepted', 'rejected'],
        'accepted' => ['in_progress', 'rejected'],
        'in_progress' => ['completed', 'cancelled'],
        'rejected' => ['pending'], // Can be rescheduled
    ];

    private const EVENT_MAP = [
        'created' => WorkOrderCreated::class,
        'assigned' => WorkOrderAssigned::class,
        'completed' => WorkOrderCompleted::class,
        'rejected' => WorkOrderRejected::class,
    ];

    public function create(array $data): WorkOrder
    {
        $workOrder = WorkOrder::create($data);
        $this->fireEvent('created', $workOrder);
        return $workOrder;
    }
    
    public function assign(WorkOrder $workOrder, User $worker): WorkOrder
    {
        return $this->updateWorkOrderStatus($workOrder, 'confirmed', [
            'assigned_to' => $worker->id,
            'price' => $this->calculatePrice($worker, $workOrder->apartment)
        ], 'assigned', $worker);
    }
    
    public function accept(WorkOrder $workOrder): WorkOrder
    {
        return $this->updateWorkOrderStatus($workOrder, 'accepted');
    }
    
    public function reject(WorkOrder $workOrder, string $reason = null): WorkOrder
    {
        return $this->updateWorkOrderStatus($workOrder, 'rejected', [
            'completion_notes' => $reason
        ], 'rejected');
    }
    
    public function complete(WorkOrder $workOrder, array $data): WorkOrder
    {
        return $this->updateWorkOrderStatus($workOrder, 'completed', [
            'completed_at' => now(),
            'completion_notes' => $data['notes'] ?? null
        ], 'completed');
    }

    private function updateWorkOrderStatus(
        WorkOrder $workOrder, 
        string $newStatus, 
        array $additionalData = [], 
        string $eventType = null, 
        mixed $eventData = null
    ): WorkOrder {
        $this->validateStatusTransition($workOrder->status, $newStatus);
        
        $updateData = array_merge(['status' => $newStatus], $additionalData);
        $workOrder->update($updateData);
        
        if ($eventType) {
            $this->fireEvent($eventType, $workOrder, $eventData);
        }
        
        return $workOrder;
    }

    private function validateStatusTransition(string $currentStatus, string $newStatus): void
    {
        $allowedTransitions = self::STATUS_TRANSITIONS[$currentStatus] ?? [];
        
        if (!in_array($newStatus, $allowedTransitions)) {
            throw new \InvalidArgumentException(
                "Invalid status transition from '{$currentStatus}' to '{$newStatus}'"
            );
        }
    }

    private function fireEvent(string $eventType, WorkOrder $workOrder, mixed $additionalData = null): void
    {
        $eventClass = self::EVENT_MAP[$eventType] ?? null;
        
        if (!$eventClass) {
            throw new \InvalidArgumentException("Unknown event type: {$eventType}");
        }

        $event = $additionalData 
            ? new $eventClass($workOrder, $additionalData)
            : new $eventClass($workOrder);
            
        Event::dispatch($event);
    }
    
    private function calculatePrice(User $worker, Apartment $apartment): ?float
    {
        return $worker->rates()
            ->where('apartment_id', $apartment->id)
            ->value('amount'); // Use correct column name
    }
}

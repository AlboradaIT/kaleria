<?php

namespace App\Services;

use App\Models\WorkOrder;
use App\Models\Apartment;
use App\Models\User;
use App\Events\WorkOrderCreated;
use App\Events\WorkOrderAssigned;
use App\Events\WorkOrderCompleted;

class WorkOrderService
{
    public function create(array $data): WorkOrder
    {
        $workOrder = WorkOrder::create($data);
        
        event(new WorkOrderCreated($workOrder));
        
        return $workOrder;
    }
    
    public function assign(WorkOrder $workOrder, User $worker): WorkOrder
    {
        $workOrder->update([
            'assigned_to' => $worker->id,
            'status' => 'confirmed',
            'price' => $this->getPrice($worker, $workOrder->apartment)
        ]);
        
        event(new WorkOrderAssigned($workOrder, $worker));
        
        return $workOrder;
    }
    
    public function accept(WorkOrder $workOrder): WorkOrder
    {
        $workOrder->update(['status' => 'accepted']);
        
        return $workOrder;
    }
    
    public function reject(WorkOrder $workOrder, string $reason = null): WorkOrder
    {
        $workOrder->update([
            'status' => 'rejected',
            'completion_notes' => $reason
        ]);
        
        // This should trigger rescheduling
        event(new WorkOrderRejected($workOrder));
        
        return $workOrder;
    }
    
    public function complete(WorkOrder $workOrder, array $data): WorkOrder
    {
        $workOrder->update([
            'status' => 'completed',
            'completed_at' => now(),
            'completion_notes' => $data['notes'] ?? null
        ]);
        
        event(new WorkOrderCompleted($workOrder));
        
        return $workOrder;
    }
    
    private function getPrice(User $worker, Apartment $apartment): ?float
    {
        $rate = $worker->rates()->where('apartment_id', $apartment->id)->first();
        
        return $rate?->price;
    }
}

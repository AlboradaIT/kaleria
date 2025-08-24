<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Livewire\Admin;
use App\Livewire\Worker;
use Illuminate\Support\Facades\Route;

// Webhook routes (no auth required)
Route::post('/webhook/smoobu', [WebhookController::class, 'smoobu'])->name('webhook.smoobu');
Route::post('/webhook/generic', [WebhookController::class, 'generic'])->name('webhook.generic');

// Domain-based routing
$adminDomain = config('domains.admin');
$workerDomain = config('domains.worker');

// Admin Domain Routes
Route::domain($adminDomain)->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/', Admin\Dashboard::class)->name('admin.dashboard');
    Route::get('/apartamentos', Admin\ApartmentIndex::class)->name('admin.apartments');
    Route::get('/ordenes-trabajo', Admin\WorkOrderIndex::class)->name('admin.work-orders');
    Route::get('/trabajadores', Admin\WorkerIndex::class)->name('admin.workers');
    Route::get('/tarifas', Admin\RateIndex::class)->name('admin.rates');
    Route::get('/reservas', Admin\BookingIndex::class)->name('admin.bookings');
});

// Worker Domain Routes  
Route::domain($workerDomain)->middleware(['auth', 'verified', 'role:worker'])->group(function () {
    Route::get('/', Worker\Dashboard::class)->name('worker.dashboard');
    Route::get('/mis-ordenes', Worker\MyOrders::class)->name('worker.orders');
});

// Default routes for development (when not using domains or accessing base domain)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        if (auth()->check()) {
            if (auth()->user()->hasRole('admin')) {
                return redirect('https://admin.kaleria.local');
            } elseif (auth()->user()->hasRole('worker')) {
                return redirect('https://worker.kaleria.local');
            }
        }
        return view('welcome');
    })->name('dashboard');
    
    // Fallback routes for when domains aren't working
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });
    
    Route::get('/worker', function () {
        return redirect()->route('worker.dashboard');
    });
});

require __DIR__.'/auth.php';

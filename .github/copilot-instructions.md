# Copilot Instructions for Kaleria - Cleaning Management Platform

## Project Overview
Kaleria is a cleaning company work order management platform with Smoobu integration. This dockerized Laravel application handles automated work orders, role-based access (admins vs workers), and apartment cleaning scheduling.

**Core Architecture:**
- **Dual Domain Setup**: Admin domain (`admin.kaleria.local`) and Worker domain (`worker.kaleria.local`)
- **Role-Based Access**: Spatie Permission with 'admin' and 'worker' roles
- **Livewire v3**: Component-based UI with Wire Elements Modal
- **Smoobu Integration**: Webhook processing for bookings/stays data
- **Media Management**: Spatie Media Library for work completion photos

## Development Environment
- **Container-based development**: Use `sail` commands for all operations
- **No local PHP required**: All PHP operations run inside containers
- **Traefik integration**: Project accessible via configured domain

## Domain Architecture
The application serves different interfaces based on domain:
- `admin.kaleria.local` - Admin management interface
- `worker.kaleria.local` - Worker task interface
- Configured via `ADMIN_DOMAIN` and `WORKER_DOMAIN` env variables

## Key Models & Relationships
```
User (HasRoles) → WorkOrder (assigned_to)
Apartment → Booking → Stay → WorkOrder (automated creation)
Apartment + User → Rate (pricing tariffs)
WebhookLog (Smoobu integration tracking)
```

## Code Style Guidelines

### HTML Formatting
Use vertical class and attributes formatting for readability:

```php
<div
    class="
        bg-white 
        rounded-lg 
        shadow 
        p-6
    "
    wire:click="openModal"
    x-data="{ open: false }"
>
    Content here
</div>
```

### Livewire Component Structure
- **Properties first**: Public properties, then protected/private
- **Lifecycle methods**: mount(), render(), etc.
- **Event listeners**: Grouped together
- **Actions**: User interaction methods
- **Helpers**: Private utility methods

### Database Conventions
- **External IDs**: All models have `external_id` for integration data
- **Status fields**: Use string enums (pending, completed, etc.)
- **Metadata**: JSON fields for flexible integration data
- **Relationships**: Clear foreign key naming (apartment_id, assigned_to)

## Development Commands

### Container Management
```bash
# Start all services
sail up -d

# Stop all services
sail down

# Rebuild containers
sail build --no-cache

# View logs
sail logs
```

### Laravel Commands
```bash
# Run migrations
sail artisan migrate

# Generate application key
sail artisan key:generate

# Create database dump
sail artisan db:dump

# Clear caches
sail artisan optimize:clear

# Create Livewire components
sail artisan make:livewire Admin/ComponentName
sail artisan make:livewire Worker/ComponentName
```

### Seeding & Testing
```bash
# Run seeders (includes roles & test users)
sail artisan db:seed

# Fresh migration with seeders
sail artisan migrate:fresh --seed

# Test webhook endpoints
curl -X POST http://localhost:8000/webhook/generic \
  -H "Content-Type: application/json" \
  -d '{"event":"test","id":"123"}'
```

## Project-Specific Patterns

### Work Order Automation
Work orders are automatically created between stay end and next booking:
- Triggered by Smoobu webhooks (stay.ended events)
- Scheduled based on apartment availability windows
- Never overlap with bookings/stays (conflict prevention)

### Role-Based Routing
```php
// Admin routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
});

// Worker routes  
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/worker/dashboard', WorkerDashboard::class)->name('worker.dashboard');
});
```

### Component Organization
- `app/Livewire/Admin/` - Administrative components
- `app/Livewire/Worker/` - Worker-facing components
- `resources/views/livewire/` - Corresponding Blade views

## Integration Points

### Smoobu Webhooks
- **Endpoint**: `/webhook/smoobu` (no auth required)
- **Logging**: All webhooks logged to `webhook_logs` table
- **Processing**: Event-driven work order creation
- **Events**: booking.created, stay.ended, booking.updated

### Media Library Integration
- Work completion photos attached to WorkOrder models
- Configured collections for different media types
- Mobile-first upload interface for workers

## Important Notes
- Always use `sail` command instead of direct `php` or `artisan`
- Database dumps are automatically created with `sail artisan db:dump`
- All file operations should maintain proper permissions
- Follow AlboradaIT naming conventions (kebab-case for projects)
- Use Livewire components for all UI interactions
- Maintain mobile-first responsive design principles

## Troubleshooting
- If containers fail to start, check `.env` configuration
- For permission issues, rebuild containers with correct WWWUSER/WWWGROUP
- For Traefik issues, ensure external network exists: `docker network create traefik`
- For Livewire issues, ensure `@livewireStyles` and `@livewireScripts` are included in layout

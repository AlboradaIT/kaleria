<?php

namespace App\Http\Controllers;

use App\Models\WebhookLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle Smoobu webhook.
     */
    public function smoobu(Request $request): JsonResponse
    {
        try {
            // Log the webhook
            $webhookLog = WebhookLog::create([
                'source' => 'smoobu',
                'event_type' => $request->input('event', 'unknown'),
                'external_id' => $request->input('id'),
                'headers' => $request->headers->all(),
                'payload' => $request->all(),
                'status' => 'received',
            ]);

            Log::info('Smoobu webhook received', [
                'webhook_log_id' => $webhookLog->id,
                'event_type' => $webhookLog->event_type,
                'external_id' => $webhookLog->external_id,
            ]);

            // TODO: Process webhook based on event type
            // This will be implemented later with proper handlers

            $webhookLog->update([
                'status' => 'processed',
                'processed_at' => now(),
            ]);

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Smoobu webhook processing failed', [
                'error' => $e->getMessage(),
                'payload' => $request->all(),
            ]);

            if (isset($webhookLog)) {
                $webhookLog->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'processed_at' => now(),
                ]);
            }

            return response()->json(['status' => 'error'], 500);
        }
    }

    /**
     * Handle generic webhook for testing.
     */
    public function generic(Request $request): JsonResponse
    {
        try {
            $webhookLog = WebhookLog::create([
                'source' => 'generic',
                'event_type' => $request->input('event', 'test'),
                'external_id' => $request->input('id'),
                'headers' => $request->headers->all(),
                'payload' => $request->all(),
                'status' => 'processed',
                'processed_at' => now(),
            ]);

            Log::info('Generic webhook received', [
                'webhook_log_id' => $webhookLog->id,
            ]);

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Generic webhook processing failed', [
                'error' => $e->getMessage(),
                'payload' => $request->all(),
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }
}

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Http\Controllers\WebhookController;

// Common
include 'Common.php';

// Front End routes
include 'Frontend.php';

// Backoffice routes
include 'Backoffice.php';

// Webhooks
// Route::post('webhook/stripe', [WebhookController::class, 'handleStripeCallback']); 		// Stripe
Route::post('stripe/webhook', [WebhookController::class, 'handleWebhook']);
// AJAX routes for get images
// Route::get('order/ajax/taxrate', [OrderController::class, 'ajaxTaxRate'])->name('ajax.taxrate');

Route::get('/clear', function () {
    //     Artisan::call('queue:work');
        // Artisan::call('optimize');
    //     Artisan::call('cache:clear');
        // Artisan::call('view:clear');
        // Artisan::call('route:list');
        // Artisan::call('clear-compiled');
        // Artisan::call('config:cache');
        // Artisan::call('config:clear');
        // Artisan::call('route:clear');
        // env wast empty this command  help
    //     return '1';
    
});

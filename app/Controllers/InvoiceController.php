<?php
namespace App\Controllers;
use App\Middleware\AuthMiddleware;

class InvoiceController {
    public function processProductForSales(array $payload) {
        AuthMiddleware::check();
        // implement invoice processing
        return ['invoice_id'=>uniqid('INV'),'input'=>$payload];
    }
}

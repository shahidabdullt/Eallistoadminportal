<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::get('/', function () {
    return view('welcome');
});




// Public routes (no middleware)
Route::get('/login', [AuthController::class, 'loginview'])->name('login');
Route::post('/admindashboard', [AuthController::class, 'Authentication'])->name('dashboard');

// Routes that require admin authentication
Route::middleware(['adminmiddleware'])->group(function () {

    Route::get('/admin/dashboardpage', [AuthController::class, 'admindashboard'])->name('admin');

    Route::get('customersinvoices', [CustomerController::class, "customersinvoiceslists"])->name('customersinvoices');

    Route::get('customerandinvoice/creation', [CustomerController::class, "customerAndInvoiceCreation"])->name('customerscreation');

    Route::post('customerandinvoiceregister', [CustomerController::class, 'customerandinvoiceregister'])->name('customerandinvoiceregister');

    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit']);

    Route::get('/invoices/{invoiceId}/edit', [CustomerController::class, 'invoiceedit']);

    Route::put('/customers/{id}/update', [CustomerController::class, 'update']);

    Route::put('/invoices/{invoiceId}/update', [CustomerController::class, 'invoiceupdate']);

    Route::post('Logout', [AuthController::class, 'Logout'])->name('Logout');
});

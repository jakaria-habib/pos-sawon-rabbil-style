<?php

use Illuminate\Support\Facades\Route;


// Pages Routes
Route::get('/', [ \App\Http\Controllers\HomeController::class, 'homePage']);
Route::get('/login-page', [ \App\Http\Controllers\UserController::class, 'loginPage']);
Route::get('/registration-page', [ \App\Http\Controllers\UserController::class, 'registrationPage']);
Route::get('/dashboard-page', [ \App\Http\Controllers\DashboardController::class, 'dashboardPage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/user-profile-page', [ \App\Http\Controllers\UserController::class, 'userProfilePage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/category-page', [ \App\Http\Controllers\CategoryController::class, 'categoryPage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/customer-page', [ \App\Http\Controllers\CustomerController::class, 'customerPage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/product-page', [ \App\Http\Controllers\ProductController::class, 'productPage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/sale-page', [ \App\Http\Controllers\InvoiceController::class, 'salePage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/invoice-page', [ \App\Http\Controllers\InvoiceController::class, 'invoicePage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/report-page',[\App\Http\Controllers\ReportController::class,'reportPage'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);


// User API
Route::post('/user-registration', [ \App\Http\Controllers\UserController::class, 'userRegistration']);
Route::post('/user-login', [ \App\Http\Controllers\UserController::class, 'userLogin']);
Route::get('/logout', [ \App\Http\Controllers\UserController::class, 'userLogout']);
Route::get('/user-profile', [ \App\Http\Controllers\UserController::class, 'getProfile'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/user-profile-update', [ \App\Http\Controllers\UserController::class, 'userProfileUpdate'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);


// Category API
Route::post('/category-create', [ \App\Http\Controllers\CategoryController::class, 'createCategory'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/category-list', [ \App\Http\Controllers\CategoryController::class, 'categoryList'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/category-by-id', [ \App\Http\Controllers\CategoryController::class, 'categoryByID'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/category-update', [ \App\Http\Controllers\CategoryController::class, 'categoryUpdate'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/category-delete', [ \App\Http\Controllers\CategoryController::class, 'categoryDelete'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);


// Customer API
Route::post('/customer-create', [ \App\Http\Controllers\CustomerController::class, 'customerCreate'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/customer-list', [ \App\Http\Controllers\CustomerController::class, 'customerList'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/customer-by-id', [ \App\Http\Controllers\CustomerController::class, 'customerByID'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/customer-update', [ \App\Http\Controllers\CustomerController::class, 'customerUpdate'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/customer-delete', [ \App\Http\Controllers\CustomerController::class, 'customerDelete'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);


// Product API
Route::post('/product-create', [ \App\Http\Controllers\ProductController::class, 'productCreate'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/product-list', [ \App\Http\Controllers\ProductController::class, 'productList'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/product-by-id', [ \App\Http\Controllers\ProductController::class, 'productByID'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/product-update', [ \App\Http\Controllers\ProductController::class, 'productUpdate'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/product-delete', [ \App\Http\Controllers\ProductController::class, 'productDelete'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);



// Invoice API
Route::post('/invoice-create', [ \App\Http\Controllers\InvoiceController::class, 'invoiceCreate'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/invoice-list', [ \App\Http\Controllers\InvoiceController::class, 'invoiceList'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/invoice-details', [ \App\Http\Controllers\InvoiceController::class, 'invoiceDetails'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::post('/invoice-delete', [ \App\Http\Controllers\InvoiceController::class, 'invoiceDelete'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);


// Summary & Sales API
Route::get('/summary',[\App\Http\Controllers\DashboardController::class,'summary'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/sales-report-preview/{FromDate}/{ToDate}',[\App\Http\Controllers\ReportController::class,'salesReportPreview'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);
Route::get('/sales-report-download/{FromDate}/{ToDate}',[\App\Http\Controllers\ReportController::class,'salesReportDownload'])->middleware(\App\Http\Middleware\TokenVerificationMiddleware::class);

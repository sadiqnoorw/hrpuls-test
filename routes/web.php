<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeFutureChangeController;

Route::get('/', [EmployeeController::class, 'index'])->name('employees');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

Route::get('/employees/{id}/future-changes', [EmployeeFutureChangeController::class, 'create'])->name('future-changes.create');
Route::post('/employees/{id}/future-changes', [EmployeeFutureChangeController::class, 'store'])->name('future-changes.store');


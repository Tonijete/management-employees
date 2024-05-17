<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('employees', [EmployeeController::class, 'index']);
Route::get('employees/create', [EmployeeController::class, 'create']);
Route::post('employees', [EmployeeController::class, 'store']);
Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit']);
Route::put('employees/{employee}', [EmployeeController::class, 'update']);
Route::delete('employees/{employee}', [EmployeeController::class, 'destroy']);

Route::resource('employees', EmployeeController::class);
Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
Route::get('employees/export/csv', [EmployeeController::class, 'exportCSV'])->name('employees.export.csv');
Route::get('employees/export/pdf', [EmployeeController::class, 'exportPDF'])->name('employees.export.pdf');



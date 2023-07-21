<?php

use Aminurdev\CrudGenerator\Http\Controllers\CrudGeneratorController;


Route::get('employee', [CrudGeneratorController::class, 'index'])->name('employee');
Route::get('employee/create', [CrudGeneratorController::class, 'create'])->name('employee.create');
Route::post('employee/store', [CrudGeneratorController::class, 'store'])->name('employee.store');
Route::get('employee/edit/{id}', [CrudGeneratorController::class, 'edit'])->name('employee.edit');
Route::put('employee/update/{id}', [CrudGeneratorController::class, 'update'])->name('employee.update');
Route::delete('employee/destroy/{id}', [CrudGeneratorController::class, 'destroy'])->name('employee.destroy');

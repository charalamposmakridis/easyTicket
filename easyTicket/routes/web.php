<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
   return redirect()->route('register');
});

Route::get('/dashboard', function () {
    return redirect()->route('tickets.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function(){
   Route::resource('tickets',\App\Http\Controllers\TicketController::class);
   Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.update-status');
   Route::patch('/tickets/{ticket}/assign', [TicketController::class, 'assignAgent'])->name('tickets.assign');


   Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
   Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
   Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');

});

Route::middleware(['auth','can:admin'])->prefix('admin')->group(function(){
   Route::resource('categories',\App\Http\Controllers\CategoryController::class)->except('show');
});

require __DIR__.'/auth.php';

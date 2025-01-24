<?php

use App\Livewire\ScreenOne;
use App\Livewire\ScreenTwo;
use App\Livewire\ScreenThree;
use Illuminate\Support\Facades\Route;

Route::get('screen-1', ScreenOne::class)->name('screen-1');
Route::get('screen-2', ScreenTwo::class)->name('screen-2');
Route::get('screen-3', ScreenThree::class)->name('screen-3');

Route::redirect('/', 'screen-1');

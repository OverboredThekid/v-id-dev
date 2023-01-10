<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\StaffWizard;
use App\Http\Livewire\Svg;
use App\Http\Livewire\Home;
use App\Http\Livewire\LinkTree;

//Staff Wizard Route ~Livewire
Route::get('staff/wizard', StaffWizard::class)->name('wizard');

//Staff ID Route ~Livewire
Route::get('staff/svg/{id}', Svg::class)->name('svg');

//Staff Link Route ~Livewire
Route::get('staff/{id}', LinkTree::class)->name('staff');
 
//Basic Index ~Livewire
Route::get('/', Home::class);

//Fallback ~Redirects
Route::fallback(function () {
    return abort(404);
});
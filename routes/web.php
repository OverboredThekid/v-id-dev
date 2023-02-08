<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\StaffWizard;
use App\Http\Livewire\Svg;
use App\Http\Livewire\LinkTree;
use App\Http\Livewire\SvgUpload;

//Staff Wizard Route ~Livewire
Route::get('staff/wizard', StaffWizard::class)->name('wizard');

//Staff ID Print Route ~Livewire
Route::get('staff/svg/{id}', Svg::class)->name('svg');

Route::get('svg/test', SvgUpload::class)->name('svg.view');
Route::post('/upload-svg', [SvgUpload::class, 'storeSvg'])->name('upload.svg');

Route::get('/view-svg-ids', function () {
    return view('svg-upload');
});


//Staff Custom Link Route ~Livewire
Route::get('staff/{id}', LinkTree::class)->name('staff')->middleware(['is.active']);
 
//Basic Index ~Filament Dash
Route::get('/', function () {
    return redirect('/admin');
});

//Fallback ~Redirects
Route::fallback(function () {
    return abort(404);
});
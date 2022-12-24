<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\StaffWizard;
use App\Http\Livewire\Svg;
use Beier\FilamentPages\Models\FilamentPage;
use App\Models\MediaLibrary;
use Illuminate\Http\Request;


//Staff Wizard Route ~Livewire
Route::get('staff/wizard', StaffWizard::class)->name('wizard');

//Staff ID Route ~Livewire
Route::get('staff/svg/{id}', Svg::class)->name('svg');

//Staff Qr Landing Page
Route::get('staff/{slug}', function () {
    $slug = FilamentPage::where('is_QrPage', '=', 1)->firstOrFail();
    return view('livewire.front-end', [
        'component' => 'FrontEnd',
        'slug' => $slug,
        'layout' => 'layouts.linkTree',
    ]);
})->middleware('is.active');


//Image Landing Page
Route::get('media/{slug?}', function (MediaLibrary $slug) {
    //return redirect($slug->getMedia('Media'));
    return $slug;

});

// Custom Pages Route
Route::get('{slug}', function (FilamentPage $slug) {
    return view('livewire.front-end', [
        'component' => 'FrontEnd',
        'slug' => $slug,
        'layout' => 'layouts.FrontEnd',
    ]);
});
//Index Page Custom Page Route
Route::get('/', function () {
    $slug = FilamentPage::where('is_index', '=', 1)->firstOrFail();
    return view('livewire.front-end', [
        'component' => 'FrontEnd',
        'slug' => $slug,
        'layout' => 'layouts.FrontEnd',
    ]);
});

//Fallback ~Redirects
Route::fallback(function () {
    return abort(404);
});
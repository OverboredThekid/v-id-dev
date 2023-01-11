<?php

namespace App\Providers;

use App\Http\Livewire\PhotoSection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected $policies = [
        'Ramnzys\FilamentEmailLog\Models\Email' => 'App\Policies\EmailPolicy',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Staff Wizard')
                    ->url(route('wizard'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-presentation-chart-line')
                    ->group('Card-Maker')
                    ->sort(2),
            ]);
        });

        Livewire::component('PhotoSection', PhotoSection::class);

    }
}

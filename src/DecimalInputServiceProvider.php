<?php

namespace Yourvendor\DecimalInput;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class DecimalInputServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/decimal-input.php',
            'decimal-input'
        );
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'decimal-input');

        $this->publishes([
            __DIR__ . '/../config/decimal-input.php' => config_path('decimal-input.php'),
        ], 'decimal-input-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/decimal-input'),
        ], 'decimal-input-views');

        Blade::component('decimal-input', Components\DecimalInput::class);
    }
}

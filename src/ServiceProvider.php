<?php

namespace Stoffelio\StatamicTurnstile;

use Statamic\Providers\AddonServiceProvider;
use Stoffelio\StatamicTurnstile\Listeners\TurnstileListener;
use Statamic\Events\FormSubmitted;
use Stoffelio\StatamicTurnstile\Tags\TurnstileTag;
use Stoffelio\StatamicTurnstile\Fieldtypes\TurnstileFieldtype;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        FormSubmitted::class => [TurnstileListener::class],
    ];

    protected $tags = [
        TurnstileTag::class,
    ];

    protected $fieldtypes = [
        TurnstileFieldtype::class,
    ];

    public function bootAddon()
    {
        parent::boot();
        
        $this->mergeConfigFrom(__DIR__ . '/../config/turnstile.php', 'turnstile');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'statamic-turnstile');

        $this->publishes([
            __DIR__ . '/../config/turnstile.php' => config_path('turnstile.php'),
        ], 'turnstile-config');

        $this->publishes([
            __DIR__ . '/../resources/views/turnstile.antlers.html' => resource_path('views/vendor/statamic-turnstile/turnstile.antlers.html'),
        ], 'turnstile-view');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/statamic-turnstile'),
        ], 'turnstile-lang');
    }
}

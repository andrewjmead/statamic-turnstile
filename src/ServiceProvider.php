<?php

namespace Stoffelio\StatamicTurnstile;

use Statamic\Providers\AddonServiceProvider;
use Stoffelio\StatamicTurnstile\Listeners\TurnstileListener;
use Statamic\Events\FormSubmitted;
use Stoffelio\StatamicTurnstile\Tags\TurnstileTag;
use Stoffelio\StatamicTurnstile\Tags\TurnstileScriptTag;
use Stoffelio\StatamicTurnstile\Fieldtypes\TurnstileFieldtype;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        FormSubmitted::class => [TurnstileListener::class],
    ];

    protected $tags = [
        TurnstileTag::class,
        TurnstileScriptTag::class,
    ];

    protected $fieldtypes = [
        TurnstileFieldtype::class,
    ];

    public function bootAddon()
    {
        parent::boot();
        
        $this->mergeConfigFrom(__DIR__ . '/../config/turnstile.php', 'turnstile');

        $this->publishes([
            __DIR__ . '/../config/turnstile.php' => config_path('turnstile.php'),
        ], 'turnstile-config');

        $this->publishes([
            __DIR__ . '/../resources/views/turnstile.antlers.html' => resource_path('views/vendor/statamic-turnstile/turnstile.antlers.html'),
        ], 'turnstile-view');
    }
}

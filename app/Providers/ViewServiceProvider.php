<?php

namespace App\Providers;

use App\Services\Blocks;
use App\View\ViewFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Component;

class ViewServiceProvider extends \Roots\Acorn\View\ViewServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->loadViewsFrom(get_theme_file_path('resources/blocks'), 'blocks');
        view()->addNamespace('blocks', get_theme_file_path('resources/blocks'));
    }

    /**
     * Create a new Factory Instance.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @param  \Illuminate\View\ViewFinderInterface  $finder
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return \Illuminate\View\Factory
     */
    protected function createFactory($resolver, $finder, $events)
    {
        return new ViewFactory($resolver, $finder, $events);
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $blocks = app(Blocks::class);
        add_action('init', [$blocks, 'registerBlocks']);
    }


}

<?php

use Jenssegers\Blade\Blade;
use Jenssegers\Blade\Container;

function view(string $view, array $data): string
{
    $container = new Container;

    Container::setInstance($container);

    $blade = new Blade(
        __DIR__.'/Support/Views',
        __DIR__.'/Support/Views/cache',
        $container
    );

    return $blade
        ->make($view, $data)
        ->render();
}

<?php

return [
    App\Providers\AppServiceProvider::class,
    BookRegistry\Assunto\Provider\AssuntoRouteProvider::class,
    BookRegistry\Assunto\Provider\AssuntoRepositoryProvider::class,
    BookRegistry\Autor\Provider\AutorRouteProvider::class,
    BookRegistry\Autor\Provider\AutorRepositoryProvider::class
];

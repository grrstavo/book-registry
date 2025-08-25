<?php

return [
    App\Providers\AppServiceProvider::class,
    BookRegistry\Assunto\Provider\AssuntoRouteProvider::class,
    BookRegistry\Assunto\Provider\AssuntoRepositoryProvider::class,
    BookRegistry\Autor\Provider\AutorRouteProvider::class,
    BookRegistry\Autor\Provider\AutorEventProvider::class,
    BookRegistry\Autor\Provider\AutorRepositoryProvider::class,
    BookRegistry\Livro\Provider\LivroRouteProvider::class,
    BookRegistry\Livro\Provider\LivroRepositoryProvider::class
];

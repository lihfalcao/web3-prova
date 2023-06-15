<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/home' => [
        'GET' => '\Controlador\VagaControlador#index',
    ],
    '/vaga/criar' => [
        'GET' => '\Controlador\VagaControlador#criar',
    ],
    '/vaga/convidar' => [
        'GET' => '\Controlador\VagaControlador#convidar',
    ],
    '/vaga/contratados' => [
        'GET' => '\Controlador\VagaControlador#contratados',
    ],
    '/perfil' => [
        'GET' => '\Controlador\UsuarioControlador#perfil',
    ],
    '/vaga' => [
        'POST' => '\Controlador\VagaControlador#armazenar',
        'GET' => '\Controlador\VagaControlador#alterarStatus',
    ],
    '/vaga/desconvidar' => [
        'GET' => '\Controlador\VagaControlador#desconvidar',
    ]
];

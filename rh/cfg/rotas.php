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
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/home' => [
        'GET' => '\Controlador\VagaControlador#index',
    ],
    '/vaga/criar' => [
        'GET' => '\Controlador\VagaControlador#criar',
    ],
    '/vaga/convidar/?' => [
        'GET' => '\Controlador\VagaControlador#convidar',
    ],
    '/perfil' => [
        'GET' => '\Controlador\UsuarioControlador#perfil',
    ],
    '/vaga' => [
        'POST' => '\Controlador\VagaControlador#armazenar',
        'DELETE' => '\Controlador\VagaControlador#destruir',
    ]
];

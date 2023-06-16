<?php
namespace Teste\Funcional;

use Modelo\Usuario;
use \Teste\Teste;

class TesteVagas extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'boss@admin.com',
            'senha' => 'admin'
        ]);
        $resposta = $this->get(URL_RAIZ . 'home');
        $this->verificarContem($resposta, 'Cadastrar Vaga');
    }

    public function testeCriarComoChefe()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'boss@admin.com',
            'senha' => 'admin'
        ]);
        $resposta = $this->get(URL_RAIZ . 'vaga/criar');
        $this->verificarContem($resposta, 'Criar');
    }

    public function testeCriarComoProgramador()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'luisa@teste.com',
            'senha' => '123'
        ]);
        $resposta = $this->get(URL_RAIZ . 'vaga/criar');
        $this->verificarNaoContem($resposta, 'Criar');
    }
}

<?php
namespace Controlador;

use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $curriculo = array_key_exists('curriculo', $_FILES) ? $_FILES['curriculo'] : null;

        $usuario = new Usuario($_POST['email'], $_POST['senha'],$_POST['nome'], $_POST['sobrenome'], $_POST['genero'], $_POST['cidade'], $_POST['uf'],
        $_POST['telefone'],  $_POST['sobre'], $_POST['idade'], $curriculo, $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'usuarios/sucesso');

        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('login/criar.php');
        }
    }

    public function sucesso()
    {
        $this->visao('usuarios/sucesso.php');
    }
}

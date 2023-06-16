<?php
namespace Controlador;

use Framework\DW3Sessao;
use \Modelo\Usuario;
use Modelo\Vaga;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function perfil()
    {
        $chefe = Vaga::buscarChefe();
        $usuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $this->visao('perfil/index.php', [
            'usuario' => $usuario,
            'chefe' => $chefe
        ]);
    }


    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $usuario = new Usuario($_POST['email'], $_POST['senha'],$_POST['nome'], $_POST['sobrenome'], $_POST['genero'], $_POST['cidade'], $_POST['uf'],
        $_POST['telefone'], $_POST['sobre'], $_POST['idade'], $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Programador cadastrado.');
            $this->redirecionar(URL_RAIZ . 'login', [
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);

        } else {
            $this->visao('login/criar.php');
        }
    }

}

<?php
namespace Controlador;

use \Framework\DW3Sessao;
use Modelo\Usuario;
use \Modelo\Vaga;

class VagaControlador extends Controlador
{
    private function calcularPaginacao($tipo, $id)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $vagas = $tipo == 'chefe' ? Vaga::buscarTodos($limit, $offset) : 
                 Vaga::buscarVagas($id, $limit, $offset);
        $ultimaPagina = ceil(Vaga::contarTodos($tipo, $id) / $limit);
        return compact('pagina', 'vagas', 'ultimaPagina');
    }

    public function criar()
    {
        $this->visao('vaga/criar.php',[
            'usuario' => Usuario::buscarId(DW3Sessao::get('usuario'))
        ]);
    }

    public function convidar()
    {
        $this->visao('vaga/convidar.php',[
            'usuario' => Usuario::buscarId(DW3Sessao::get('usuario'))
        ]);
    }

    public function index()
    {
        $this->verificarLogado();
        $usuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $chefe = Vaga::buscarChefe();
        $tipo = $usuario->getId() == $chefe->getId() ? 'chefe' : 'programador';
        $paginacao = $this->calcularPaginacao($tipo, $usuario->getId());
        $this->visao('home/index.php', [
            'vagas' => $paginacao['vagas'],
            'pagina' => $paginacao['pagina'],
            'usuario' => $usuario,
            'chefe' => $chefe,
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'MensagemFlash' => DW3Sessao::getFlash('HomeFlash')
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        
        $vaga = new Vaga(
            DW3Sessao::get('usuario'),
            $_POST['texto'],
            '',
            ''
        );
        if ($vaga->isValido()) {
            $vaga->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem cadastrada.');
            $this->redirecionar(URL_RAIZ . 'mensagens');

        } else {
            $usuario = Usuario::buscarId(DW3Sessao::get('usuario'));
            $chefe = Vaga::buscarChefe();
            $tipo = $usuario->getId() == $chefe->getId() ? 'chefe' : 'programador';
            $paginacao = $this->calcularPaginacao($tipo, $usuario->getId());
            $this->setErros($vaga->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => $paginacao['mensagens'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    // public function destruir($id)
    // {
    //     $this->verificarLogado();
    //     $vaga = Vaga::buscarId($id);
    //     if ($vaga->getUsuario() == $this->getUsuario()) {
    //         Vaga::destruir($id);
    //         DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
    //     } else {
    //         DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
    //     }
    //     $this->redirecionar(URL_RAIZ . 'mensagens');
    // }
}

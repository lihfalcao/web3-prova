<?php
namespace Controlador;

use \Framework\DW3Sessao;
use Modelo\Usuario;
use \Modelo\Vaga;

class VagaControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $vagas = Vaga::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Vaga::contarTodos() / $limit);
        return compact('pagina', 'vagas', 'ultimaPagina');
    }

    public function criar()
    {
        $this->visao('vaga/criar.php');
    }

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('home/index.php', [
            'vagas' => $paginacao['vagas'],
            'pagina' => $paginacao['pagina'],
            'usuario' =>Usuario::buscarId(DW3Sessao::get('usuario')),
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
            $paginacao = $this->calcularPaginacao();
            $this->setErros($vaga->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => $paginacao['mensagens'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $vaga = Vaga::buscarId($id);
        if ($vaga->getUsuario() == $this->getUsuario()) {
            Vaga::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'mensagens');
    }
}

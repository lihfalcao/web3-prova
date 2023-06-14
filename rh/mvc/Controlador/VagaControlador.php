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
                 ($tipo == 'rh' ? Vaga::buscarVagas($id, $limit, $offset) :
                Vaga::buscarAceitos($limit, $offset));
        $ultimaPagina = ceil(Vaga::contarTodos($tipo, $id) / $limit);
        return compact('pagina', 'vagas', 'ultimaPagina');
    }

    public function criar()
    {
        $programadores = Usuario::buscarProgramadores();
        $this->visao('vaga/criar.php',[
            'usuario' => Usuario::buscarId(DW3Sessao::get('usuario')),
            'programadores' => $programadores
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
        $tipo = $usuario->getId() == $chefe->getId() ? 'chefe' : ( $usuario->isAdmin() ? 'rh' : 'programador');
        $paginacao = $this->calcularPaginacao($tipo, $usuario->getId());
        $this->visao('home/index.php', [
            'vagas' => $paginacao['vagas'],
            'pagina' => $paginacao['pagina'],
            'usuario' => $usuario,
            'chefe' => $chefe,
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        
        $vaga = new Vaga(
            $_POST['cargo'],
            $_POST['framework'],
            $_POST['salario'],
            $_POST['tipo'],
            $_POST['programador'],
            'convidado',
        );
        if ($vaga->isValido()) {
            $vaga->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Vaga cadastrada.');
            $this->redirecionar(URL_RAIZ . 'home');

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

}

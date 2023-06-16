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
        $vagas = $tipo == 'chefe' ? Vaga::buscarTodos($limit, $offset, $_GET) : 
                 ($tipo == 'programador' ? Vaga::buscarVagas($id, $limit, $offset) :
                 ($tipo == 'rh' ? Vaga::buscarAceitos($limit, $offset)
                 : Vaga::buscarContratados($limit, $offset)));
        $ultimaPagina = ceil(Vaga::contarTodos($tipo, $id) / $limit);
        return compact('pagina', 'vagas', 'ultimaPagina');
    }

    public function criar()
    {
        $this->verificarLogado();

        $programadores = Usuario::buscarProgramadoresDisponiveis();
        $this->visao('vaga/criar.php',[
            'usuario' => Usuario::buscarId(DW3Sessao::get('usuario')),
            'programadores' => $programadores
        ]);
    }

    public function contratados()
    {
        $this->verificarLogado();

        $usuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $tipo = 'contratados';
        $paginacao = $this->calcularPaginacao($tipo, $usuario->getId());

        $this->visao('vaga/contratados.php',[
            'vagas' => $paginacao['vagas'],
            'pagina' => $paginacao['pagina'],
            'usuario' => $usuario,
            'ultimaPagina' => $paginacao['ultimaPagina'],
        ]);
    }


    public function convidar()
    {
        $this->verificarLogado();

        $this->visao('vaga/convidar.php',[
            'usuario' => Usuario::buscarId(DW3Sessao::get('usuario')),
            'programador' => Usuario::buscarId($_GET['id'])
        ]);
    }

    public function alterarStatus()
    {
        if($_GET['status'] == 'recusado'){
            Vaga::desconvidar($_GET['programador']);
            DW3Sessao::setFlash('mensagemFlashDanger', 'Convite Recusado.');
        } else {
            Vaga::alterarStatus($_GET['status'], $_GET['id'], $_GET['programador']);
            DW3Sessao::setFlash('mensagemFlash', $_GET['status'] == 'aceito' ? 'Convite Aceito' : 'Programador Contratado');
        }
        $this->redirecionar(URL_RAIZ . 'home');
    }


    public function desconvidar()
    {
        Vaga::desconvidar($_GET['id']);
        DW3Sessao::setFlash('mensagemFlashDanger', 'Programador desconvidado.');
        $this->redirecionar(URL_RAIZ . 'home');
    }

    public function index()
    {
        $this->verificarLogado();

        $usuario = Usuario::buscarId(DW3Sessao::get('usuario'));
        $chefe = Vaga::buscarChefe();
        $tipo = $usuario->getId() == $chefe->getId() ? 'chefe' : ( $usuario->isAdmin() ? 'rh' : 'programador');
        $paginacao = $this->calcularPaginacao($tipo, $usuario->getId());
        $programadores = Usuario::buscarProgramadores();
        $this->visao('home/index.php', [
            'vagas' => $paginacao['vagas'],
            'pagina' => $paginacao['pagina'],
            'usuario' => $usuario,
            'chefe' => $chefe,
            'programadores' => $programadores,
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash'),
            'mensagemFlashDanger' => DW3Sessao::getFlash('mensagemFlashDanger')

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

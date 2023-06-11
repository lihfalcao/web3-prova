<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Vaga extends Modelo
{
    const BUSCAR_TODOS = 'SELECT v.*, programador.email as programador_email, programador.nome as programador_nome, programador.sobrenome as programador_sobrenome,programador.criado_dia as programador_criado_dia, programador.genero as programador_genero, programador.cidade as programador_cidade, programador.uf as programador_uf FROM vagas v LEFT JOIN usuarios programador ON (v.programador = programador.id) ORDER BY programador.nome LIMIT ? OFFSET ?';
    const BUSCAR_ID = 'SELECT * FROM vagas WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO vagas(usuario_id,texto) VALUES (?, ?)';
    const DELETAR = 'DELETE FROM vagas WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM vagas';
    private $id;
    private $usuarioId;
    private $programador;
    private $statusProposta;
    private $texto;
    private $usuario;

    public function __construct(
        $usuarioId,
        $texto,
        $programador,
        $statusProposta,
        $id = null,
        $usuario = null,
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->programador = $programador;
        $this->statusProposta = $statusProposta;
        $this->texto = $texto;
        $this->usuario = $usuario;

    }

    public function getId()
    {
        return $this->id;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }


    public function getProgramador()
    {
        return $this->programador;
    }

    public function getStatusProposta()
    {
        return $this->statusProposta;
    }


    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->id, PDO::PARAM_INT);
        $comando->bindValue(2, $this->texto, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Vaga(
                $registro['usuario_id'],
                $registro['texto'],
                null,
                $registro['id']
            );
        }
        return $objeto;
    }

    /* Além de buscar as mensagens, eu também busco, na mesma consulta,
    os dados dos usuários, usando um JOIN. Essa é a forma correta de
    resolver o problema: query N+1. Com apenas uma consulta no banco
    eu busco tudo que eu preciso.
    */
    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $programador = new Usuario(
                $registro['programador_email'],
                '',
                $registro['programador_nome'],
                $registro['programador_sobrenome'],
                $registro['programador_genero'],
                $registro['programador_cidade'],
                $registro['programador_uf'],
                $registro['programador_telefone'],
                $registro['programador_sobre'],
                $registro['programador_idade'],
                null,
                null,
                $registro['programador_empresa'],
                $registro['programador_admin'],
                $registro['programador_id'],
            );
            $objetos[] = new Vaga(
                $registro['id'],
                $registro['usuarioId'],
                $programador,
                $registro['status_proposta'],
            );
        }
        
        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if (strlen($this->texto) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }
}

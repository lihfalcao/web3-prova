<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Vaga extends Modelo
{
    const BUSCAR_TODOS = 'SELECT usuarios.*, vagas.id as vaga_id, vagas.status_proposta FROM usuarios LEFT JOIN vagas on vagas.programador = usuarios.id 
    WHERE usuarios.programador = true  ORDER BY nome ASC LIMIT ? OFFSET ?';
    const BUSCAR_VAGAS = 'SELECT vagas.* FROM vagas WHERE programador = ?  ORDER BY id ASC LIMIT ? OFFSET ?';
    const BUSCAR_CHEFE = 'SELECT * FROM usuarios WHERE programador = false AND admin = false LIMIT 1';
    const BUSCAR_ID = 'SELECT * FROM vagas WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO vagas(usuario_id,texto) VALUES (?, ?)';
    const DELETAR = 'DELETE FROM vagas WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM usuarios WHERE usuarios.programador = true';
    const CONTAR_VAGAS = 'SELECT count(id) FROM vagas WHERE programador = ?';
    private $id;
    private $programador;
    private $statusProposta;

    public function __construct(
        $programador,
        $statusProposta,
        $id = null,
    ) {
        $this->id = $id;
        $this->programador = $programador;
        $this->statusProposta = $statusProposta;
    }

    public function getId()
    {
        return $this->id;
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
        $comando->bindValue(2, $this->statusProposta, PDO::PARAM_STR);
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
                $registro['email'],
                '',
                $registro['nome'],
                $registro['sobrenome'],
                $registro['genero'],
                $registro['cidade'],
                $registro['uf'],
                $registro['telefone'],
                $registro['sobre'],
                $registro['idade'],
                null,
                null,
                $registro['empresa'],
                $registro['admin'],
                $registro['id'],
            );
            $objetos[] = new Vaga(
                $programador,
                $registro['status_proposta'],
                $registro['vaga_id']
            );
        }
        
        return $objetos;
    }

    public static function buscarVagas($id, $limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_VAGAS);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->bindValue(2, $limit, PDO::PARAM_INT);
        $comando->bindValue(3, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Vaga(
                $id,
                $registro['status_proposta'],
                $registro['vaga_id']
            );
        }
        
        return $objetos;
    }

    public static function contarTodos($tipo, $id)
    {
        if($tipo == 'chefe'){
            $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        } else {
            $registros = DW3BancoDeDados::prepare(self::CONTAR_VAGAS);
            $registros->bindValue(1, $id, PDO::PARAM_INT);
            $registros->execute();
        }
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function buscarChefe()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_CHEFE);
        $chefe = $registros->fetch();
        return new Usuario(
            $chefe['email'],
            '',
            $chefe['nome'],
            $chefe['sobrenome'],
            $chefe['genero'],
            $chefe['cidade'],
            $chefe['uf'],
            $chefe['telefone'],
            $chefe['sobre'],
            $chefe['idade'],
            null,
            null,
            $chefe['empresa'],
            $chefe['admin'],
            $chefe['id'],
        );
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if (strlen($this->statusProposta) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }
}

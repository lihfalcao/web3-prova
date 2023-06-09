<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Vaga extends Modelo
{
    const BUSCAR_TODOS = 'SELECT usuarios.*, vagas.id as vaga_id, vagas.status_proposta, vagas.cargo FROM usuarios LEFT JOIN vagas on vagas.programador = usuarios.id 
    WHERE usuarios.programador = true';
    const BUSCAR_ACEITOS = 'SELECT usuarios.*, vagas.id as vaga_id, vagas.status_proposta, vagas.cargo FROM usuarios LEFT JOIN vagas on vagas.programador = usuarios.id 
    WHERE usuarios.programador = true AND vagas.status_proposta = "aceito" ORDER BY nome ASC LIMIT ? OFFSET ?';
    const BUSCAR_CONTRATADOS = 'SELECT usuarios.*, vagas.id as vaga_id, vagas.status_proposta, vagas.cargo FROM usuarios LEFT JOIN vagas on vagas.programador = usuarios.id 
    WHERE usuarios.programador = true AND vagas.status_proposta = "contratado" ORDER BY nome ASC LIMIT ? OFFSET ?';
    const BUSCAR_VAGAS = 'SELECT vagas.* FROM vagas WHERE programador = ? AND status_proposta = "convidado" ORDER BY id ASC LIMIT ? OFFSET ?';
    const BUSCAR_CHEFE = 'SELECT * FROM usuarios WHERE programador = false AND admin = false LIMIT 1';
    const BUSCAR_ID = 'SELECT * FROM vagas WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO vagas(cargo, framework, salario, tipo, data_convite, programador, status_proposta) VALUES (?, ?, ?, ?, ?, ?, ?)';
    const CONTAR_TODOS = 'SELECT count(id) FROM usuarios WHERE usuarios.programador = true';
    const CONTAR_VAGAS = 'SELECT count(id) FROM vagas WHERE programador = ?';
    const DESCONVIDAR = 'DELETE FROM vagas WHERE id = ?';
    const ALTERAR_STATUS = 'UPDATE vagas SET status_proposta = ? WHERE id = ?';
    const CONTRATAR = 'UPDATE usuarios SET empresa = "CodeWave" WHERE id = ?';

    private $id;
    private $cargo;
    private $framework;
    private $salario;
    private $tipo;
    private $dataConvite;
    private $programador;
    private $statusProposta;

    public function __construct(
        $cargo,
        $framework,
        $salario,
        $tipo,
        $programador,
        $statusProposta,
        $id = null,
    ) {
        $this->id = $id;
        $this->cargo = $cargo;
        $this->framework = $framework;
        $this->salario = $salario;
        $this->tipo = $tipo;
        $this->dataConvite = date("Y/m/d");
        $this->programador = $programador;
        $this->statusProposta = $statusProposta;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFramework()
    {
        return $this->framework;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getDataConvite()
    {
        return $this->dataConvite;
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
        $comando->bindValue(1, $this->cargo, PDO::PARAM_STR);
        $comando->bindValue(2, $this->framework, PDO::PARAM_STR);
        $comando->bindValue(3, $this->salario, PDO::PARAM_STR);
        $comando->bindValue(4, $this->tipo, PDO::PARAM_STR);
        $comando->bindValue(5, $this->dataConvite, PDO::PARAM_STR);
        $comando->bindValue(6, $this->programador, PDO::PARAM_INT);
        $comando->bindValue(7, $this->statusProposta, PDO::PARAM_STR);
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
                $registro['cargo'],
                $registro['framework'],
                $registro['salario'],
                $registro['tipo'],
                $registro['programador'],
                $registro['status_proposta'],
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
    public static function buscarTodos($limit = 4, $offset = 0, $filtro = [])
    {
        $sqlWhere = '';
        $parametros = [];
        if (array_key_exists('nome', $filtro) && $filtro['nome'] != '') {
            $parametros[] = '%' . $filtro['nome'] . '%';
            $sqlWhere .= ' AND usuarios.nome LIKE ?';
        }

        $sql = self::BUSCAR_TODOS . $sqlWhere . ' ORDER BY nome ASC LIMIT ' . $limit . ' OFFSET ' . $offset;

        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $comando->bindValue($i+1, $parametro, PDO::PARAM_STR);
        }
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
                $registro['empresa'],
                $registro['admin'],
                $registro['id'],
            );
            $objetos[] = new Vaga(
                $registro['cargo'],
                '',
                '',
                '',
                $programador,
                $registro['status_proposta'],
                $registro['vaga_id']
            );
        }
        
        return $objetos;
    }

    public static function buscarAceitos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ACEITOS);
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
                $registro['empresa'],
                $registro['admin'],
                $registro['id'],
            );
            $objetos[] = new Vaga(
                $registro['cargo'],
                '',
                '',
                '',
                $programador,
                $registro['status_proposta'],
                $registro['vaga_id']
            );
        }
        
        return $objetos;
    }

    public static function buscarContratados($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_CONTRATADOS);
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
                $registro['empresa'],
                $registro['admin'],
                $registro['id'],
            );
            $objetos[] = new Vaga(
                $registro['cargo'],
                '',
                '',
                '',
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
                $registro['cargo'],
                $registro['framework'],
                $registro['salario'],
                $registro['tipo'],
                $id,
                $registro['status_proposta'],
                $registro['id']
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
            $chefe['empresa'],
            $chefe['admin'],
            $chefe['id'],
        );
    }

    public static function desconvidar($id)
    {
        $registros = DW3BancoDeDados::prepare(self::DESCONVIDAR);
        $registros->bindValue(1, $id, PDO::PARAM_INT);
        $registros->execute();
        
        return $registros->fetch();
    }

    public static function alterarStatus($status, $id, $programador)
    {
        $registros = DW3BancoDeDados::prepare(self::ALTERAR_STATUS);
        $registros->bindValue(1, $status, PDO::PARAM_STR);
        $registros->bindValue(2, $id, PDO::PARAM_INT);
        $registros->execute();

        if($status == 'contratado'){
            $contrato = DW3BancoDeDados::prepare(self::CONTRATAR);
            $contrato->bindValue(1, $programador, PDO::PARAM_INT);
            $contrato->execute();
        }
        
        return $registros->fetch();
    }
}

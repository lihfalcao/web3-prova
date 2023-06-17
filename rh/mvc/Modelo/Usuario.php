<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const BUSCAR_PROGRAMADORES = 'SELECT nome, id FROM usuarios WHERE programador = 1 ORDER BY nome ASC';
    const BUSCAR_PROGRAMADORES_DISPONIVEIS = 'SELECT nome, id FROM usuarios WHERE programador = 1 AND empresa is Null ORDER BY nome ASC';
    const INSERIR = 'INSERT INTO usuarios(email, senha, programador, telefone, sobre, nome, sobrenome, genero, cidade, uf, criado_dia, idade, empresa, admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    private $id;
    private $email;
    private $senha;
    private $senhaPlana;
    private $programador;
    private $telefone;
    private $sobre;
    private $nome;
    private $sobrenome;
    private $genero;
    private $cidade;
    private $uf;
    private $criadoDia;
    private $idade;
    private $foto;
    private $empresa;
    private $admin;



    public function __construct(
        $email,
        $senhaPlana,
        $nome,
        $sobrenome,
        $genero,
        $cidade,
        $uf,
        $telefone,
        $sobre,
        $idade,
        $foto = null,
        $empresa = null,
        $admin = false,
        $id = null

    ) {
        $this->email = $email;
        $this->id = $id;
        $this->programador = true;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->genero = $genero;
        $this->telefone = $telefone;
        $this->sobre = $sobre;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->criadoDia = date("Y/m/d");
        $this->idade = $idade;
        $this->foto = $foto;
        $this->empresa = $empresa;
        $this->senhaPlana = $senhaPlana;
        $this->admin = $admin;


        if ($senhaPlana != null) {
            $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCriadoDia()
    {
        return $this->criadoDia;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function getSobre()
    {
        return $this->sobre;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function getImagem()
    {

        $imagemNome = "{$this->id}{$this->nome}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }

    public function isProgramador()
    {
        return $this->programador;
    }

    public function isAdmin()
    {
        return $this->admin;
    }


    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    protected function verificarErros()
    {
        if (strlen($this->email) < 3) {
            $this->setErroMensagem('email', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
        }

        if (DW3ImagemUpload::existeUpload($this->foto)
        && !DW3ImagemUpload::isValida($this->foto)) {
        $this->setErroMensagem('foto', 'Deve ser de no máximo 1000 KB.');
        }

    }

    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->email, PDO::PARAM_STR);
        $comando->bindValue(2, $this->senha, PDO::PARAM_STR);
        $comando->bindValue(3, $this->programador, PDO::PARAM_STR);
        $comando->bindValue(4, $this->telefone, PDO::PARAM_STR);
        $comando->bindValue(5, $this->sobre, PDO::PARAM_STR);
        $comando->bindValue(6, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(7, $this->sobrenome, PDO::PARAM_STR);
        $comando->bindValue(8, $this->genero, PDO::PARAM_STR);
        $comando->bindValue(9, $this->cidade, PDO::PARAM_STR);
        $comando->bindValue(10, $this->uf, PDO::PARAM_STR);
        $comando->bindValue(11, $this->criadoDia, PDO::PARAM_STR);
        $comando->bindValue(12, $this->idade, PDO::PARAM_INT);
        $comando->bindValue(13, $this->empresa, PDO::PARAM_STR);
        $comando->bindValue(14, $this->admin, PDO::PARAM_BOOL);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}{$this->nome}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }

    }

    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
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
            $objeto->senha = $registro['senha'];
            $objeto->nome = $registro['nome'];

        }
        return $objeto;
    }


    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
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
                $registro['id']
            );

        }
        return $objeto;
    }

    public static function buscarProgramadores()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_PROGRAMADORES);
        return $registros->fetchAll();
    }

    public static function buscarProgramadoresDisponiveis()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_PROGRAMADORES_DISPONIVEIS);
        return $registros->fetchAll();
    }
}

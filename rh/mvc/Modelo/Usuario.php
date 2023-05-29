<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(email, senha, tipo, telefone, sobre, nome, cidade, uf, criado_dia, idade, foto, empresa_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    private $id;
    private $email;
    private $senha;
    private $senhaPlana;
    private $tipo;
    private $telefone;
    private $sobre;
    private $nome;
    private $cidade;
    private $uf;
    private $criadoDia;
    private $idade;
    private $foto;
    private $empresaId;

    public function __construct(
        $email,
        $senhaPlana,
        $tipo,
        $foto = null,
        $id = null,
        $telefone = null,
        $sobre = null,
        $nome = null,
        $cidade = null,
        $uf = null,
        $criadoDia = null,
        $idade = null,
        $empresaId = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->tipo = $tipo;
        $this->telefone = $telefone;
        $this->sobre = $sobre;
        $this->nome = $nome;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->criadoDia = $criadoDia;
        $this->idade = $idade;
        $this->foto = $foto;
        $this->empresaId = $empresaId;
        $this->senhaPlana = $senhaPlana;

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

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
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

    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->email, PDO::PARAM_STR);
        $comando->bindValue(2, $this->senha, PDO::PARAM_STR);
        $comando->bindValue(3, $this->tipo, PDO::PARAM_STR);
        $comando->bindValue(4, $this->telefone, PDO::PARAM_STR);
        $comando->bindValue(5, $this->sobre, PDO::PARAM_STR);
        $comando->bindValue(6, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(7, $this->cidade, PDO::PARAM_STR);
        $comando->bindValue(8, $this->uf, PDO::PARAM_STR);
        $comando->bindValue(9, $this->criadoDia, PDO::PARAM_STR);
        $comando->bindValue(10, $this->idade, PDO::PARAM_STR);
        $comando->bindValue(11, $this->foto, PDO::PARAM_STR);
        $comando->bindValue(12, $this->empresaId, PDO::PARAM_STR);

        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
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
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }
}

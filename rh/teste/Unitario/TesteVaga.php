<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;
use Modelo\Vaga;

class TesteVaga extends Teste
{
	public function testeCriar()
    {
        $vaga = new Vaga('Desenvolvedor Frontend', 'Vue', '5000,00', 'Presencial', 3, 'convidado');
        $vaga->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM vagas WHERE id = " . $vaga->getId());
        $bdVaga = $query->fetch();
        $this->verificar($bdVaga['programador'] == 3);
    }
}

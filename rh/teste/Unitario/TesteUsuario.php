<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
	public function testeInserir()
	{
        $usuario = new Usuario('email-teste', 'senha','John', 'Doe', 'M', 'Cascavel', 'PR', '4599999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 33, NULL);
        $usuario->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE email = 'email-teste'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);
	}

    public function testeBuscarEmail()
    {

        $usuario = new Usuario('email-teste', 'senha', 'John', 'Doe', 'M', 'Cascavel', 'PR', '4599999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 33, NULL);
        $usuario->salvar();
        $usuario = Usuario::buscarEmail('email-teste');
        $this->verificar($usuario !== false);
    }
}

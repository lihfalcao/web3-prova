<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeLogin()
    {
        (new Usuario('joao@teste.com', '123','John', 'Doe', 'M', 'Cascavel', 'PR', '4599999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 33, NULL))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'home');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarContem($resposta, 'joao@teste.com');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('joao@teste.com', '123','John', 'Doe', 'M', 'Cascavel', 'PR', '4599999999', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu lacus eu neque pretium malesuada in sed ipsum. Integer eget risus blandit, elementum elit sit amet, dignissim velit. Duis nunc urna, vestibulum ac arcu at, lobortis suscipit nisi. Nam feugiat felis id eros fermentum, et consectetur lorem viverra. Mauris feugiat massa eget purus aliquam aliquet. Duis imperdiet at ligula quis pulvinar. Pellentesque eu posuere nulla. Mauris et massa justo. Praesent placerat facilisis eros. Integer ipsum risus, malesuada at tortor nec, vehicula suscipit nunc. Etiam in blandit velit, et aliquam ante. Sed vel mi nulla.<br/>Donec luctus malesuada viverra. Mauris facilisis molestie pretium. Integer luctus dapibus metus, auctor venenatis erat consequat nec. Nulla at ex sed ante finibus dictum eu a lectus. Vivamus porta non velit ut elementum. Duis porttitor felis et ipsum iaculis, eu vestibulum neque ullamcorper. Morbi pellentesque lectus metus, at iaculis mi lacinia sit amet. Ut accumsan diam nisi, vel rhoncus tortor pharetra vitae. Aliquam et turpis lacinia, iaculis ante vel, fringilla dolor. Vivamus euismod tempor pharetra. Nunc orci sapien, vehicula quis lacus eget, convallis euismod odio.', 33, NULL))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}

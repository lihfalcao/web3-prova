<link rel="stylesheet" href="<?= URL_CSS . 'login.css' ?>">

<div class="container">
    <div class="buttonsForm">
      <div class="btnColor"></div>
      <button id="btnSignin">Login</button>
      <button id="btnSignup">Cadastrar</button>
    </div>

   <form action="<?= URL_RAIZ . 'login' ?>" method="post" id="signin">
      <div class="form-group <?= $this->getErroCss('login') ?>">
          <input name="email" placeholder='E-mail' type='text' class="form-control" autofocus value="<?= $this->getPost('email') ?>">
      </div>
      <div class="form-group <?= $this->getErroCss('login') ?>">
          <input name="senha" placeholder='Senha' class="form-control" type="password">
      </div>
      <div class="form-group has-error text-center">
          <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>

      </div>
      <button type="submit">Entrar</button>
    </form>
    <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" enctype="multipart/form-data" id="signup">
      <div class="form-group <?= $this->getErroCss('email') ?>">
          <input name="email" placeholder='E-mail' type='text' class="form-control" autofocus value="<?= $this->getPost('email') ?>">
      </div>
      <div class="form-group <?= $this->getErroCss('senha') ?>">
          <input name="senha" placeholder='Senha' class="form-control" type="password">
      </div>
      <div class="form-group <?= $this->getErroCss('nome') ?>">
          <input name="nome" placeholder='Nome' class="form-control" type="text">
      </div>
      <div class="form-group <?= $this->getErroCss('sobrenome') ?>">
          <input name="sobrenome" placeholder='Sobrenome' class="form-control" type="text">
      </div>
      <div class="form-group <?= $this->getErroCss('Telefone') ?>">
          <input name="telefone" placeholder='telefone' class="form-control" type="text">
      </div>
      <div class="form-group <?= $this->getErroCss('idade') ?>">
          <input name="idade" placeholder='Idade' class="form-control" type="number">
      </div>
      <div class="form-group <?= $this->getErroCss('genero') ?>">
          <select name="genero" class="form-control" id="genero" style="border-radius: 60px; border: none; margin-top: 30px">
              <option value="M" selected>Masculino</option>
              <option value="F">Feminino</option>
        </select>
      </div>
      <div class="form-group <?= $this->getErroCss('cidade') ?>">
          <input name="cidade" placeholder='Cidade' class="form-control" type="text">
      </div>
      <div class="form-group <?= $this->getErroCss('uf') ?>">
          <select name="uf" class="form-control" id="uf" style="border-radius: 60px; border: none; margin-top: 30px">
              <option value="MG">Minas Gerais</option>
              <option value="PR" selected>Paraná</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>

        </select>
      </div>
      <div class="form-group <?= $this->getErroCss('sobre') ?>">
          <textarea name="sobre" placeholder='sobre' class="form-control"></textarea>
      </div>
      <div class="form-group <?= $this->getErroCss('foto') ?>">
           <label class="control-label" style="font-size:small; text-transform:uppercase"for="foto">Currículo (somente PDF)</label>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'curriculo']) ?>
            <input id="curriculo" name="curriculo" class="form-control" type="file">
      </div>
      <div class="form-group <?= $this->getErroCss('foto') ?>">
           <label class="control-label" style="font-size:small; text-transform:uppercase"for="foto">Foto (somente PNG)</label>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'foto']) ?>
            <input id="foto" name="foto" class="form-control" type="file">
      </div>
      <button type="submit" style="margin-top:10px">Cadastrar</button>
    </form>
  </div>

<dialog>
  <div id="modal-content">
    <h2 id="modal-title">Sucesso</h2>
    <hr style="margin-bottom: 2em;"/>
    <p class="modal-text">Seu cadastro foi realizado com sucesso!</p>
    <p class="modal-text">Efetuar login para acessar seu perfil</p>
    <button id="confirm">Confirmar</button>
  </div>
</dialog>

<script src="<?= URL_JS . 'login.js'?>"></script>

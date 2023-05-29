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
      <div class="form-group <?= $this->getErroCss('senha2') ?>">
          <input name="senha2" placeholder='Confirmar Senha' class="form-control" type="password">
      </div>
      <div class="form-group">
          <select name="tipo" class="form-control" required>
            <option value="">Selecione o tipo de usuário...</option>
            <option value="programador">Programador</option>
            <option value="chefe">Chefe</option>
            <option value="rh">RH</option>
          </select>
      </div>
      <div class="divCheck">
        <input type="checkbox"  required />
        <span>Aceito os Termos de Cadastramento</span>
      </div>
      <button type="submit">Cadastrar</button>
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

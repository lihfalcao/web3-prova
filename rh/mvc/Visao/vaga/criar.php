<link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
<link rel="stylesheet" href="<?= URL_CSS . 'vaga.css' ?>">

<header class="site-header">
          <div class="site-header__top">
            <div class="wrapper site-header__wrapper">
              <div class="site-header__middle">
                <h1 class="brand">RH+++</h1>
              </div>
              <div class="site-header__end top">
                <p style="color:gray; font-weight: bold; margin: auto"><?= ($usuario->getGenero() == 'M' ? 'Bem-vindo ' : 'Bem-vinda ') . $usuario->getNome() ?></p>
                <form action="<?= URL_RAIZ . 'login' ?>" method="post">
                  <input type="hidden" name="_metodo" value="DELETE">
                  <button id="logout" >Logout</button>
                </form>
              </div>
            </div>
          </div>
          <div class="site-header__bottom">
            <div class="wrapper site-header__wrapper">
				<div class="site-header__start">
							<nav class="nav">
							<ul class="nav__wrapper">
								<li class="nav__item"><a href="<?= URL_RAIZ . 'home' ?>" id="home">Home</a></li>
								<li class="nav__item"><a href="<?= URL_RAIZ . 'vaga/criar' ?>" id="vaga">Cadastrar Vaga</a></li>
							</ul>
							</nav>
				</div>
              <div class="site-header__end bottom">
               
                <button id="profile" title="Meu Perfil" style="outline:none"><i class="fa fa-user" aria-hidden="true" onclick="location.href='<?= URL_RAIZ . 'perfil' ?>'"></i></button> 
    
                </a>
            </div>
        </div>
    </div>
</header>

<div class="container">
  <form action="<?= URL_RAIZ . 'vaga' ?>" method="post">
        <div class="form-group">
            <input name="cargo" placeholder='Cargo' type='text' class="form-control" autofocus value="<?= $this->getPost('cargo') ?>">
        </div>
        <div class="form-group">
            <input name="framework" placeholder='Framework' class="form-control" type="text">
        </div>
        <div class="form-group">
            <input name="salario" id="salario" placeholder='Salário' class="form-control" type="text">
        </div>
        <div class="form-group">
          <select name="tipo" class="form-control" id="tipo">
                <option value="Presencial" selected>Presencial</option>
                <option value="Remota">Remota</option>
                <option value="Híbrida">Híbrida</option>
          </select>
        </div>
        <div class="form-group">
          <select name="programador" class="form-control" id="programador">
                <option value="">Selecione...</option>
                <?php foreach ($programadores as $programador) : ?>
                <option value="<?= $programador['id'] ?>"><?= $programador['nome'] ?></option>
                <?php endforeach ?>
          </select>
        </div>

        <button type="submit">Criar</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="<?= URL_JS . 'vaga.js'?>"></script>

<link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">

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
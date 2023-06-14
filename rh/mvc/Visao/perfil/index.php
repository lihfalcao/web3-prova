<link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
<link rel="stylesheet" href="<?= URL_CSS . 'profile.css' ?>">


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
								<?php if ( $chefe->getId() ==  $usuario->getId()) : ?>
								<li class="nav__item"><a href="<?= URL_RAIZ . 'vaga/criar' ?>" id="vaga">Cadastrar Vaga</a></li>
								<?php endif ?>
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


<section class="ftco-section" style="margin-top:1em">
		<div class="container">
			<div class="row">
				<div class="d-flex">
					<div style="width: 30em;">
            <img src="<?= URL_IMG . $usuario->getImagem() ?>" alt="Imagem do perfil" style="width:15em; margin-left:1em">
						<p class="title" style="margin-left: 2em;"><?= $usuario->getNome() . ' ' . $usuario->getSobrenome()?></p>
						<p class="subtitle"><?= $usuario->getIdade() . ' anos - ' . $usuario->getCidade() . ' - ' . $usuario->getUf() ?></p>
            <p class="subtitle"><?= ($usuario->getGenero() == 'F' ? 'Feminino': 'Masculino') . ' - ' . $usuario->getTelefone() ?></p>
            <?php $date=date_create($usuario->getCriadoDia());?>
						<p class="subtitle">Membro desde: <?= date_format($date,"d/m/Y");?></p>

					</div>
					<div class="col-md-8">
						<p class="title">Sobre</p>
						<p class="text"><?= $usuario->getSobre() ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

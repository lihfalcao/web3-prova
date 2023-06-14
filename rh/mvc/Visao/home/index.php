<link rel="stylesheet" href="<?= URL_CSS . 'home.css' ?>">
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

<div class="container">
	<?php if ($mensagemFlash) : ?>
		<div class="alert alert-success alert-dismissible" style="margin-top: 2em">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= $mensagemFlash ?>
		</div>
	<?php endif ?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
					<?php if ( $chefe->getId() ==  $usuario->getId()) : ?>
						<table class="table table-responsive-xl">
						<thead>
						    <tr>
						      <th>&nbsp;</th>
						      <th>Email</th>
						      <th>Nome</th>
						      <th>Vaga</th>
						      <th>Status</th>
						      <th>&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php foreach ($vagas as $vaga) : ?>
						    <tr class="alert" role="alert">
						    	<td>
						    	</td>
							
						      <td class="d-flex align-items-center">
							  	<img src="<?= URL_IMG . $vaga->getProgramador()->getImagem() ?>" alt="Imagem do perfil" class="imagem-usuario pull-left">
						      	<div class="pl-3 email">
						      		<span><?= $vaga->getProgramador()->getEmail() ?></span>
									<?php $date=date_create($vaga->getProgramador()->getCriadoDia());?>
						      		<span>Membro desde: <?= date_format($date,"d/m/Y"); ?></span>
						      	</div>
						      </td>
						      <td>
								<p style="font-weight: bold;"><?= $vaga->getProgramador()->getNome() ?> <?= $vaga->getProgramador()->getSobrenome() ?></p>
						      	<p style="margin-top: 0.5em; text-transform: uppercase; font-size: smaller; color: gray;"><?= $vaga->getProgramador()->getCidade() ?> - <?= $vaga->getProgramador()->getUf() ?></p>
							  </td>
							  <td><?= $vaga->getCargo() ?></td>
							  <?php if ($vaga->getStatusProposta() == 'contratado' || $vaga->getProgramador()->getEmpresa()) : ?>
								<td class="status"><span class="accept">Contratado</span></td>
								<td></td>
							  <?php elseif ($vaga->getStatusProposta() == 'convidado' ) : ?>
								<td class="status"><span class="waiting">Convidado</span></td>
								<form action="<?= URL_RAIZ . 'vaga/desconvidar' ?>" method="post">
								<td> <button class="uninvite" type="submit">Desconvidar</button> </td>
								</form>
							  <?php else: ?>
								<td class="status"><span class="active">Disponível</span></td>
								<td> <button class="invite" style="outline:none" onclick="location.href='<?= URL_RAIZ . 'vaga/convidar/' . $vaga->getProgramador()->getId() ?>'">Convidar</button> </td>
							  <?php endif ?>
						    </tr>
						<?php endforeach ?>
						</tbody>
					</table>
					<?php endif ?>
					<?php if ( count($vagas) == 0 && !$usuario->isAdmin() ) : ?>
						<h2 style="text-align:center; margin:40px">Não há convites feitos ainda, continue aguardando!</h2>
					<?php endif ?>
					<?php if ( count($vagas) == 0 && $usuario->isAdmin() ) : ?>
						<h2 style="text-align:center; margin:40px">Nenhum programador aceitou convite ainda, continue aguardando!</h2>
					<?php endif ?>
					<div style="float:right">
						<?php if ($pagina > 1) : ?>
							<a href="<?= URL_RAIZ . 'home?p=' . ($pagina-1) ?>" class="previous">&#8249;</a>
						<?php endif ?>
						<?php if ($pagina < $ultimaPagina) : ?>
								<a href="<?= URL_RAIZ . 'home?p=' . ($pagina+1) ?>" class="next">&#8250;</a>
						<?php endif ?>
					</div>
					</div>
				</div>
			</div>
		</div>

		<script src="<?= URL_JS . 'bootstrap.min.js'?>"></script>
		<script src="<?= URL_JS . 'jquery.min.js'?>"></script>
		<script src="<?= URL_JS . 'popper.js'?>"></script>

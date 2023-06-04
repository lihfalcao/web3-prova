<link rel="stylesheet" href="<?= URL_CSS . 'home.css' ?>">
<link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">


<header class="site-header">
          <div class="site-header__top">
            <div class="wrapper site-header__wrapper">
              <div class="site-header__middle">
                <h1 class="brand">RH+++</h1>
              </div>
              <div class="site-header__end top">
                <p>Bem-vindo <?= $usuario ?></p>
                <button id="logout">Logout</button>
              </div>
            </div>
          </div>
          <div class="site-header__bottom">
            <div class="wrapper site-header__wrapper">
              <div class="site-header__start">
                <nav class="nav">
                  <ul class="nav__wrapper">
                    <li class="nav__item"><a href="#" id="home">Home</a></li>
                    <li class="nav__item"><a href="/rh/home.html" id="rh">RH</a></li>
                    <li class="nav__item"><a href="/programmer/home.html" id="programmer">Programador</a></li>
                  </ul>
                </nav>
              </div>
    
              <div class="site-header__end bottom">
               
                <button id="profile" title="Meu Perfil" style="outline:none"><i class="fa fa-user" aria-hidden="true"></i></button> 
    
                </a>
              </div>
            </div>
          </div>
        </header>

<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-responsive-xl">
						  <thead>
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>Email</th>
						      <th>Nome</th>
						      <th>&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr class="alert" role="alert">
						    	<td>
						    	</td>
							<?php foreach ($vagas as $vaga) : ?>
							<?php if($vaga->getStatusProposta() === 1) : ?>

						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(../assets/images/person_1.png);"></div>
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
							  <?php endif?>
							  <?php endforeach ?>
							<td></td>
						    </tr>
						    <tr class="alert" role="alert">
						    	<td>
						    	</td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(../assets/images/person_2.png);"></div>
						      	<div class="pl-3 email">
						      		<span>alinasouza@email.com</span>
						      		<span>Membro desde: 01/03/2020</span>
						      	</div>
						      </td>
						      <td>
								<p style="font-weight: bold;">Alina Souza</p>
						      	<p style="margin-top: 0.5em; text-transform: uppercase; font-size: smaller; color: gray;">Guarapuava - PR</p>
							  </td>
						      <td></td>
							<td></td>

						    </tr>
						    <tr class="alert" role="alert">
						    	<td>
						    	</td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(../assets/images/person_3.png);"></div>
						      	<div class="pl-3 email">
						      		<span>larrybird@email.com</span>
						      		<span>Membro desde: 01/03/2020</span>
						      	</div>
						      </td>
						      <td>
								<p style="font-weight: bold;">Larry Johnson</p>
						      	<p style="margin-top: 0.5em; text-transform: uppercase; font-size: smaller; color: gray;">São Paulo - SP</p>
							  </td>
						      <td>
				        	</td>
							<td></td>
						    </tr>
						    <tr class="alert" role="alert">
						    	<td>
						    	</td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(../assets/images/person_4.png);"></div>
						      	<div class="pl-3 email">
						      		<span>johndoe@email.com</span>
						      		<span>Membro desde: 01/03/2020</span>
						      	</div>
						      </td>
						      <td>
								<p style="font-weight: bold;">John Doe</p>
						      	<p style="margin-top: 0.5em; text-transform: uppercase; font-size: smaller; color: gray;">Guarapuava - PR</p>
							  </td>
							<td></td>
						    </tr>
						    <tr class="alert" role="alert">
						    	<td class="border-bottom-0">
						    	</td>
						      <td class="d-flex align-items-center border-bottom-0">
						      	<div class="img" style="background-image: url(../assets/images/person_5.png);"></div>
						      	<div class="pl-3 email">
						      		<span>garybird@email.com</span>
						      		<span>Membro desde: 01/03/2020</span>
						      	</div>
						      </td>
						      <td class="border-bottom-0">
								<p style="font-weight: bold;">Gary Copper</p>
						      	<p style="margin-top: 0.5em; text-transform: uppercase; font-size: smaller; color: gray;">Cascavel - PR</p>
							  </td>
						      <td class="border-bottom-0">
				        	</td>
							<td></td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<script src="<?= URL_JS . 'bootstrap.min.js'?>"></script>
		<script src="<?= URL_JS . 'jquery.min.js'?>"></script>
		<script src="<?= URL_JS . 'popper.js'?>"></script>
		<script src="<?= URL_JS . 'main.js'?>"></script>
		<script src="<?= URL_JS . 'home.js'?>"></script>

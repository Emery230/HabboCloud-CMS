<header id="header" class="header-dynamic header-shadow-scroll">
			<div class="container">
				<a class="logo" href="/">
					<img src="<?= $this->App('url'); ?>/app/assets/views/img/logos/header-light.png" alt="">
				</a>
				<nav>
					<ul class="nav-primary">
						<li>
							<a href="/"><i class="fa fa-home icon-left"></i>Accueil</a>
						</li>
						<li>
							<a href="/Solutions"><i class="fa fa-shopping-cart icon-left"></i>Nos solutions</a>
						</li>
						<li>
							<a class="button button-secondary" href="<?php if(isset($_SESSION['account']['sso'])) { echo '/Client/Dashboard'; } else { echo '/Login'; } ?>">
								<i class="fa fa-user icon-left"></i>Espace client
							</a>
						</li>
						<?php if(isset($_SESSION['account']['sso'])) { ?>
						<li>
							<a class="button button-primary" href="/Logout">
								<i class="fa fa-power-off icon-left"></i>Déconnexion
							</a>
						</li>
						<?php } ?>
					</ul>
					<ul class="nav-secondary">
						<li>
							<a href="Status_Servers"><i class="fa fa-server icon-left"></i>État des serveurs</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>
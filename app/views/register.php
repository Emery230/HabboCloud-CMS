<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Inscription - <?= $this->App('name'); ?></title>
		<meta name="description" content="Inscription">
		<meta name="keywords" content="espace client, register, inscription">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="apple-touch-icon-precomposed" href="<?= $this->App('favicon'); ?>">
		<link rel="icon" href="<?= $this->App('favicon'); ?>">
		<link rel="stylesheet" href="<?= $this->App('url'); ?>/app/assets/views/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= $this->App('url'); ?>/app/assets/views/css/main.min.css">
	</head>
	<body class="footer-dark">
		<?php include 'app/views/header.tpl'; ?>
		<section id="content">
			<section class="content-row content-row-color content-row-clouds">
				<div class="container">
					<header class="content-header content-header-small content-header-uppercase">
						<h1>
							Inscription
						</h1>
						<p>
							L'inscription au site est 100% gratuit.
						</p>
					</header>
				</div>
			</section>
			<section class="content-row">
				<div class="container">
					<div class="column-row align-center">
						<div class="column-50">
							<div id="error"></div>
							<form class="form-full-width" id="hc_register">
								<div class="form-row">
									<label for="form-email">Nom d'utilisateur</label>
									<input id="form-email" type="text" name="username">
								</div>
								<div class="form-row">
									<label for="form-email">Adresse email</label>
									<input id="form-email" type="email" name="email">
								</div>
								<div class="form-row">
									<label for="form-password">Mot de passe</label>
									<input id="form-password" type="password" name="password">
								</div>
								<div class="form-row">
									<button class="button-secondary"><i class="fa fa-sign-in icon-left"></i>S'inscrire</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</section>
		<footer id="footer">
			<section class="footer-secondary">
				<div class="container">
					<p>
						&copy; Copyright <?= date('Y'); ?> <?= $this->App('name'); ?>. Tous droits réservés.
					</p>
				</div>
			</section>
		</footer>
		<script src="<?= $this->App('url'); ?>/app/assets/views/js/jquery.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/views/js/headroom.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/views/js/js.cookie.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/views/js/imagesloaded.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/views/js/bricks.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/views/js/main.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/ajax/register.js"></script>
	</body>
</html>
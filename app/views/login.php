<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Espace client - <?= $this->App('name'); ?></title>
		<meta name="description" content="Espace client">
		<meta name="keywords" content="espace client, login, connexion">
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
							Espace client
						</h1>
						<p>
							Connectez-vous ou inscrivez-vous et passez votre première commande.
						</p>
					</header>
				</div>
			</section>
			<section class="content-row">
				<div class="container">
					<div class="column-row align-center">
						<div class="column-50">
							<div id="error"></div>
							<form class="form-full-width" id="hc_login">
								<div class="form-row">
									<label for="form-email">Adresse email</label>
									<input id="form-email" type="email" name="email">
								</div>
								<div class="form-row">
									<label for="form-password">Mot de passe</label>
									<input id="form-password" type="password" name="password">
								</div>
								<div class="form-row">
									<button class="button-secondary"><i class="fa fa-sign-in icon-left"></i>Se connecter</button>
									<a href="/Register" class="button button-primary"><i class="fa fa-user-plus icon-left"></i>S'inscrire</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
			<section class="content-row content-row-gray">
				<div class="container">
					<div class="column-row align-center">
						<div class="column-50 text-align-center">
							<p class="text-color-gray">
								Vous avez perdu votre mot de passe?<br>
								<a href="/forgot-password">Réinitialiser mon mot de passe<i class="fa fa-angle-right icon-right"></i></a>
							</p>
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
		<script src="<?= $this->App('url'); ?>/app/ajax/login.js"></script>
	</body>
</html>
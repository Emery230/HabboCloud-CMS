<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Solutions - <?= $this->App('name'); ?></title>
		<meta name="description" content="Solutions">
		<meta name="keywords" content="solutions">
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
							Nos Solutions
						</h1>
						<p>
							Voici la liste des solutions proposés par <?= $this->App('name'); ?>
						</p>
					</header>
				</div>
			</section>
			<section class="content-row">
				<div class="container">
					<div class="column-row">
						<?php
						
						$db = MySQL::Database();
						
						$Solutions = $db->query('SELECT * FROM hc_solutions');
						
						while($S = $Solutions->fetch()) {
							echo '<div class="column-35">
							<div class="product-box">
								<div class="product-header">
									<h4>
										Solution '.$S['name'].'
									</h4>
									<p>
										'.$S['mini_description'].'
									</p>
								</div>
								<div class="product-price">
									Dès '.$S['price_default'].'€<span class="term">/ mois</span>
								</div>
								<div class="product-features">
									<ul>
										<li>
											<strong>'.$S['storage_disk'].' Go</strong> de stockage disque <i style="color: green" class="fa fa-check"></i>
										</li>
										<li>
											<stike><strong>Choix du CMS</strong> '.$this->OptionSolutions2($S['option_liste_cms']).'
										</li>
										<li>
											<strong>Choix de l\'émulateur</strong> '.$this->OptionSolutions2($S['option_liste_emulator']).'
										</li>
										<li>
											<strong>Support téléphonique</strong> '.$this->OptionSolutions2($S['option_support_phone']).'
										</li>
										<li>
											<strong>Propre VPS, SWF, MySQL</strong> '.$this->OptionSolutions2($S['option_full']).'
										</li>
									</ul>
									<ul>
										
									</ul>
								</div>
								<div class="product-order">
									<a class="button button-secondary" href="">
										<i class="fa fa-shopping-cart icon-left"></i>Commander
									</a>
								</div>
							</div>
						</div>';
						}
						
						?>
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
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= $this->App('name'); ?> - Créer un rétro-habbo n'a jamais été aussi facile</title>
		<meta name="description" content="<?= $this->App('description'); ?>">
		<meta name="keywords" content="<?= $this->App('keywords'); ?>">
		<link rel="icon" href="<?= $this->App('url'); ?>/app/assets/manager/images/Icon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="apple-touch-icon-precomposed" href="<?= $this->App('favicon'); ?>">
		<link rel="apple-touch-icon" sizes="120x120" href="<?= $this->App('url'); ?>/app/assets/images/apple-touch-icon-120x120-precomposed.png" /> 
		<link rel="apple-touch-icon" sizes="152x152" href="<?= $this->App('url'); ?>/app/assets/images//apple-touch-icon-152x152-precomposed.png" />
		<link rel="icon" href="<?= $this->App('favicon'); ?>">
		<link rel="stylesheet" href="<?= $this->App('url'); ?>/app/assets/views/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= $this->App('url'); ?>/app/assets/views/css/main.min.css">
	</head>
	<body class="footer-dark">
		<?php include 'app/views/header.tpl'; ?>
		<section id="notification" data-dismissible="true" data-title="" data-expires="">
			<div class="container">
				<p>
					Commandez dès maintenant votre rétro-habbo et soyez livré sous 48 heures
				</p>
			</div>
		</section>
		<section id="content">
			<section class="content-row content-row-color content-row-clouds">
				<div class="content-slider animate-container-slide" data-nav="true" data-rotation="5">
					<?php
					
					$db = MySQL::Database();
					
					$Solutions = $db->query('SELECT * FROM hc_solutions');
					
					while($S = $Solutions->fetch()) {
						echo '<a class="slide" data-title="'.$S['name'].'" href="/Solutions">
						<div class="container">
							<header class="content-header content-header-large content-header-uppercase">
								<h1>
									Solution <mark>'.$S['name'].'</mark>
								</h1>
								<p>
									'.$S['description'].', à partir de <span class="text-color-secondary">'.$S['price_default'].'€/mois</span>
								</p>
							</header>
							<img src="uploads/server-shared.png" alt="">
						</div>
					</a>';
					}
					
					?>
				</div>
			</section>
			<section class="content-row">
				<div class="container">
					<header class="content-header">
						<h2>
							Habbo Cloud Plate-forme
						</h2>
						<p>
							Déployez votre rétro-habbo sur notre plate-forme haute performance entièrement redondante et bénéficiez de sa haute fiabilité, de sa sécurité et de ses fonctionnalités.
						</p>
					</header>
					<div class="column-row align-center-bottom text-align-center">
						<div class="column-33">
							<i class="fa fa-rocket icon-feature"></i>
							<h3>
								Haute Performance
							</h3>
							<p>
								Nos serveurs vous propose une protection Anti-DDoS Premium ainsi qu'un réseau très rapide.
							</p>
						</div>
						<div class="column-33">
							<i class="fa fa-refresh icon-feature"></i>
							<h3>
								Livraison sous 48 heures
							</h3>
							<p>
								Vos rétros-habbo sont livrer sous 48 heures à compter de la validation de la commande.
							</p>
						</div>
						<div class="column-33">
							<i class="fa fa-shield icon-feature"></i>
							<h3>
								Sécurité renforcé
							</h3>
							<p>
								Toutes nos solutions sont vérifiés et tenu à jour pour vous proposer une sécurité maximal.
							</p>
						</div>
					</div>
				</div>
			</section>
			
			
			<section class="content-row content-row-gray">
				<div class="container">
					<header class="content-header">
						<h2>
							Avis des clients
						</h2>
						<p>
							Trois avis de nos clients sont affichés au hazard pour vous montrer la fiabilité de Habbo Cloud.
						</p>
					</header>
					<div class="column-row align-center-bottom">
						<?php
						
						$Opinions = $db->query('SELECT * FROM hc_opinions ORDER BY rand() LIMIT 3');
						
						while($O = $Opinions->fetch()) {
							
							$UserInfo = $db->prepare('SELECT sso, username, rank FROM hc_users WHERE sso = ?');
							$UserInfo->execute(array($O['sso']));
							
							$fetchUserInfo = $UserInfo->fetch();
							
							echo '<div class="column-33">
							<div class="testimonial">
								<p class="testimonial-content">
									'.wordwrap($O['message'], 40, "\n", true).'
								</p>
								<p class="testimonial-author">
									<a style="text-decoration: none" href="#"><i class="fa fa-user icon-left"></i>'.$fetchUserInfo['username'].'</a><br>
									<small>'.$this->Rank($fetchUserInfo['rank'], 'letter').'</small>
								</p>
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
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>État des serveurs - <?= $this->App('name'); ?></title>
		<meta name="description" content="État des serveurs">
		<meta name="keywords" content="état des serveurs">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="apple-touch-icon-precomposed" href="<?= $this->App('favicon'); ?>">
		<link rel="<?= $this->App('favicon'); ?>">
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
							État des serveurs
						</h1>
						<p>
							Suivez l'état des serveurs en temps réel.
						</p>
					</header>
					<div class="column-row align-center" style="margin-top: -90px;">
						<div class="column-66">
							<div class="tab-group tab-group-switch-style">
								<div class="tab-item active" data-title="Primary Locations"><div class="tab-item-inner">
									<table class="table-layout-fixed">
										<thead>
											<tr>
												<th>Nom du serveur</th>
												<th>Type</th>
												<th>État</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$db = MySQL::Database();
											
											$ServersLists = $db->query('SELECT * FROM hc_servers');
											
											while($SL = $ServersLists->fetch()) {
												echo '<tr>
												<td class="has-responsive-th"><span class="responsive-th">Nom du serveur</span>'.$SL['name'].'</td>
												<td class="has-responsive-th"><span class="responsive-th">Type</span>'.$SL['type'].'</td>
												'.$this->GetServerStatut($SL['ip'], $SL['port']).'
											</tr>';
											}
											
											?>
										</tbody>
									</table>
								</div></div>
							</div>
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
	</body>
</html>
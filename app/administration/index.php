<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width initial-scale=1.0">
		<title>
			Administration - 
			<?= $this->
			App('name'); ?>
		</title>
		<link href="<?= $this->App('url'); ?>/app/assets/administration/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="<?= $this->App('url'); ?>/app/assets/administration/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
		<link href="<?= $this->App('url'); ?>/app/assets/administration/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet"/>
		<link href="<?= $this->App('url'); ?>/app/assets/administration/vendors/themify-icons/css/themify-icons.css" rel="stylesheet"/>
		<link href="<?= $this->App('url'); ?>/app/assets/administration/vendors/animate.css/animate.min.css" rel="stylesheet"/>
		<link href="<?= $this->App('url'); ?>/app/assets/administration/vendors/toastr/toastr.min.css" rel="stylesheet"/>
		<link href="<?= $this->App('url'); ?>/app/assets/administration/assets/css/main.css" rel="stylesheet"/>
	</head>
	<body class="boxed-layout">
		<div class="page-wrapper">
			<header class="header">
				<div class="clf header-topbar">
					<div class="wrapper">
						<div class="page-brand">
							<a class="link" href="index.html">
								<span class="brand">Habbo.<span class="brand-tip">Cloud</span></span>
							</a>
						</div>
						<ul class="nav pull-left navbar-toolbar">
							<li>
								<a class="nav-link sidebar-toggler js-sidebar-toggler">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a>
							</li>
						</ul>
						<ul class="nav pull-right navbar-toolbar">
							<li class="dropdown dropdown-user">
								<a class="nav-link dropdown-toggle link" data-toggle="dropdown">
									<span class="<?= $this->Rank($_SESSION['account']['rank'], 'color'); ?>"><?= $_SESSION['account']['username']; ?></span>
									<img src="<?= $_SESSION['account']['avatar']; ?>">
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="/manager/settings"><i class="ti-settings"></i>Paramètres</a>
									<a class="dropdown-item" href="/logout"><i class="ti-power-off"></i>Déconnexion</a>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<?php include 'app/administration/navigator.tpl'; ?>
			</header>
			<div class="wrapper content-wrapper">
				<div class="page-content fade-in-up">
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-info alert-dismissable fade show">
								<h4><?php if(date('H') >= 5 AND date('H') <= 17) { echo 'Bonjour'; } else { echo 'Bonsoir'; } ?> <b><?= $_SESSION['account']['username']; ?></b></h4>
								<p>L'administration est une partie du site réservé à l'équipe, aucune capture d'écran et aucune insulte ne sera acceptée. Tout ce que vous faites est enregistré.</p>
								<p>
									<a href="/manager/" class="btn btn-success">Accéder au site</a>
									<a href="/logout" class="btn btn-warning">Déconnexion</a>
								</p>
							</div>
						</div>
					</div>
					<div class="row">
						<?php
						
						$db = MySQL::Database();
						
						if($_SESSION['account']['rank'] >= 5) {
							
						
						?>
						<div class="col-md-6">
							<div class="ibox">
								<div class="ibox-head">
									<div class="ibox-title">Commandes en attente</div>
									<div class="ibox-tools">
										Dépèche toi de livrer fdp
									</div>
								</div>
								<div class="ibox-body">
									 <?php
									  
										$Commandes = $db->query('SELECT * FROM hc_orders ORDER BY date LIMIT 10');
										$rowCount = $Commandes->rowCount();
										if($rowCount == 0) {
											echo 'Aucune commande';
										} else {
								
											echo '<table class="table table-striped">
													<thead>
													<tr>
													<th>#</th>
													<th>Nom</th>
													<th>Extension</th>
													<th>Solution</th>
													<th>CMS</th>
													<th>Émulateur</th>
													<th>Action</th>
													</tr>
													</thead>
													<tbody> ';
							
											while($T = $Commandes->fetch()) {
												echo '<tr>
												<td>'.$T['id'].'</td>
												<td>'.$T['name'].'</td>
												<td>'.$T['extension'].'</td>
												<td>'.$T['solution'].'</td>
												<td>'.$T['cms'].'</td>
												<td>'.$T['emulator'].'</td>
												<td><a href="/administration/commandes/waiting/'.$T['id'].'">Livrer</a></td>
												</tr>';
											}
											
											echo '</tbody>
											</table>';
										}
									
									  ?>
								</div>
							</div>
						</div>
						<?php } else { ?>
						<div class="col-md-6">
							<div class="ibox">
								<div class="ibox-head">
									<div class="ibox-title">Tickets en attente</div>
									<div class="ibox-tools">
										Dépèche toi de répondre connard
									</div>
								</div>
								<div class="ibox-body">
									 <?php
									  
										$Tickets = $db->prepare('SELECT * FROM hc_support WHERE status = ? OR status = ? ORDER BY created_at LIMIT 10');
										$Tickets->execute(array('open', 'waiting'));
										$rowCount = $Tickets->rowCount();
										if($rowCount == 0) {
											echo 'Aucun ticket';
										} else {
								
											echo '<table class="table table-striped">
													<thead>
													<tr>
													<th>#</th>
													<th>Sujet</th>
													<th>Département</th>
													<th>Ouvert</th>
													<th>Action</th>
													</tr>
													</thead>
													<tbody> ';
							
											while($T = $Tickets->fetch()) {
												echo '<tr>
												<td>'.$T['id'].'</td>
												<td>'.$T['sujet'].'</td>
												<td>'.$T['department'].'</td>
												<td>'.$this->ConvertTime($T['created_at']).'
												<td><a href="/administration/ticket/'.$T['id'].'">Voir</a></td>
												</tr>';
											}
											
											echo '</tbody>
											</table>';
										}
									
									  ?>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php
						
						if($_SESSION['account']['rank'] >= 5) {
						
						?>
						<div class="col-md-6">
							<div class="ibox">
								<div class="ibox-head">
									<div class="ibox-title">Tickets en attente</div>
									<div class="ibox-tools">
										Dépèche toi de répondre connard
									</div>
								</div>
								<div class="ibox-body">
									 <?php
									  
										$Tickets = $db->prepare('SELECT * FROM hc_support WHERE status = ? OR status = ? ORDER BY created_at LIMIT 10');
										$Tickets->execute(array('open', 'waiting'));
										$rowCount = $Tickets->rowCount();
										if($rowCount == 0) {
											echo 'Aucun ticket';
										} else {
								
											echo '<table class="table table-striped">
													<thead>
													<tr>
													<th>#</th>
													<th>Sujet</th>
													<th>Département</th>
													<th>Ouvert</th>
													<th>Action</th>
													</tr>
													</thead>
													<tbody> ';
							
											while($T = $Tickets->fetch()) {
												echo '<tr>
												<td>'.$T['id'].'</td>
												<td>'.$T['sujet'].'</td>
												<td>'.$T['department'].'</td>
												<td>'.$this->ConvertTime($T['created_at']).'
												<td><a href="/administration/tickets/'.$T['id'].'">Voir</a></td>
												</tr>';
											}
											
											echo '</tbody>
											</table>';
										}
									
									  ?>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/jquery-idletimer/dist/idle-timer.min.js" type="text/javascript"></script>
	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/toastr/toastr.min.js" type="text/javascript"></script>

	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js" type="text/javascript"></script>
	    <script src="<?= $this->App('url'); ?>/app/assets/administration/vendors/jquery-sparkline/dist/jquery.sparkline.min.js" type="text/javascript"></script>

	    <script src="<?= $this->App('url'); ?>/app/assets/administration/assets/js/app.js" type="text/javascript"></script>

	    <script src="<?= $this->App('url'); ?>/app/assets/administration/assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
	</body>
</html>
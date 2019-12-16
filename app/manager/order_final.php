<?php

$db = MySQL::Database();
										
$Solutions = $db->prepare('SELECT * FROM hc_solutions WHERE id = ?');
$Solutions->execute(array($get_id));
$rowCount = $Solutions->rowCount();

if($rowCount == 0) {
	header('Location: /Client/Order');
} else {
	$fetch = $Solutions->fetch();
}

$_SESSION['order'] = array('id' => $get_id);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $this->App('name'); ?> Espace Client</title>

        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet">
		<link rel="icon" href="<?= $this->App('url'); ?>/app/assets/manager/images/Icon.png">
        <link href="<?= $this->App('url'); ?>/app/assets/manager/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $this->App('url'); ?>/app/assets/manager/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= $this->App('url'); ?>/app/assets/manager/plugins/icomoon/style.css" rel="stylesheet">
        <link href="<?= $this->App('url'); ?>/app/assets/manager/plugins/uniform/css/default.css" rel="stylesheet"/>
        <link href="<?= $this->App('url'); ?>/app/assets/manager/plugins/switchery/switchery.min.css" rel="stylesheet"/>
        <link href="<?= $this->App('url'); ?>/app/assets/manager/plugins/nvd3/nv.d3.min.css" rel="stylesheet">  
      
        <link href="<?= $this->App('url'); ?>/app/assets/manager/css/space.min.css" rel="stylesheet">
        <link href="<?= $this->App('url'); ?>/app/assets/manager/css/custom.css" rel="stylesheet">
		<link href="<?= $this->App('url'); ?>/app/assets/manager/css/habbo-cloud.css" rel="stylesheet">
		<link href="<?= $this->App('url'); ?>/app/assets/manager/css/loading.css" rel="stylesheet">
		<link href="<?= $this->App('url'); ?>/app/assets/manager/themes/blue/pace-theme-flash.css" rel="stylesheet">
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/habbo-cloud.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/pace.js"></script>
    </head>
    <body>
        
        <div class="page-container">
			<nav class="navbar navbar-inverse navbar-fixed-top hc_new_navig">
				<div class="">
					<div class="navbar-header">
						<button type="button" class="hc_button_responsible navbar-toggle collapsed" id="sidebar-toggle-button">
							<i class="fa fa-bars hc_navig_responsible"></i>
						</button>
						<a class="espace_client_title navbar-brand" href="#"><span class="hc_logo">HC</span> Espace Client</a>
					</div>
					<div id="navbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<?php include 'app/manager/notifications.tpl'; ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons hc_icon_bar">person_outline</i></a>
								<ul class="dropdown-menu hc_dropdown_menu">
									<li><a href="/Client/Settings">Paramètres</a></li>
									<li><a href="/Logout">Déconnexion</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
            <?php include 'app/manager/navigator.tpl'; ?>
			
            <div class="page-content">
				<div class="page-header" style="">
					<nav class="navbar navbar-default"></nav>
				</div>
				<div class="page-inner">
					<div id="main-wrapper">
						<div class="hc_header">
								Finalisation du nouveau service
							</div>
						<div class="row hc_container">
							<div class="col-md-9">
								<div id="error"></div>
								<div class="hc_box_header_sup hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_new_offers_box_title" style="text-align:left">Solution <?= $fetch['name']; ?><div class="pull-right"><?= $fetch['price_default'] * 100; ?> Point<?= $this->Many($fetch['price_default'] * 100); ?> /mois</div></h3>
												<hr>
												<?php
										
										$Solutions = $db->prepare('SELECT * FROM hc_solutions WHERE id = ?');
										$Solutions->execute(array($get_id));
										
										$rowCount = $Solutions->rowCount();
										$fetch = $Solutions->fetch();
										
										if($rowCount == 0) {
											exit;
										} else { ?>
										<form id="hc_order">
											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Nom du rétro</label>
													<input type="text" name="name" id="name" class="form-control" placeholder="Nom du rétro">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">CMS</label>
													<select class="form-control" name="cms">
														<?php if($fetch['option_liste_cms'] == 0) {
															if($fetch['rp'] == 0) {
																$SelectCMSDefault = $db->prepare('SELECT * FROM hc_lists_cms WHERE default_cms = ?');
																$SelectCMSDefault->execute(array(1));
																while($s = $SelectCMSDefault->fetch()) {
																	echo '<option value="'.$s['name'].'">'.$s['name'].'</option>';
																}
															} else {
																$SelectCMSDefault = $db->prepare('SELECT * FROM hc_lists_cms WHERE default_cms = ?');
																$SelectCMSDefault->execute(array('rp'));
																while($s = $SelectCMSDefault->fetch()) {
																	echo '<option value="'.$s['name'].'">'.$s['name'].'</option>';
																}
															}
														} else {
															$SelectCMS = $db->prepare('SELECT * FROM hc_lists_cms WHERE default_cms = ? OR default_cms = ?');
															$SelectCMS->execute(array(0, 1));
															while($CMS = $SelectCMS->fetch()) {
																echo '<option value="'.$CMS['name'].'">'.$CMS['name'].'</option>';
															}
														} ?>
													</select>
												</div>
												
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputPassword1">Extension</label>
													<select class="form-control" name="extension">
														<?php 
												
														$ListsExtensions = $db->query('SELECT * FROM hc_lists_extensions');
												
														while($E = $ListsExtensions->fetch()) {
															echo '<option value="'.$E['extension'].'">'.$E['extension'].'</option>';
														}
												
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Émulateur</label>
													<select class="form-control" name="emulator">
														<?php if($fetch['option_liste_emulator'] == 0) {
															if($fetch['rp'] == 0) {
																$SelectEmulatorDefault = $db->prepare('SELECT * FROM hc_lists_emulators WHERE default_emulator = ?');
																$SelectEmulatorDefault->execute(array(1));
																while($s = $SelectEmulatorDefault->fetch()) {
																	echo '<option value="'.$s['name'].'">'.$s['name'].'</option>';
																}
															} else {
																$SelectEmulatorDefault = $db->prepare('SELECT * FROM hc_lists_emulators WHERE default_emulator = ?');
																$SelectEmulatorDefault->execute(array('rp'));
																while($s = $SelectEmulatorDefault->fetch()) {
																	echo '<option value="'.$s['name'].'">'.$s['name'].'</option>';
																}
															}
														} else {
															$SelectEmulator = $db->prepare('SELECT * FROM hc_lists_emulators WHERE default_emulator = ? OR default_emulator = ?');
															$SelectEmulator->execute(array(0, 1));
															while($Emulator = $SelectEmulator->fetch()) {
																echo '<option value="'.$Emulator['name'].'">'.$Emulator['name'].'</option>';
															}
														} ?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<button class="btn btn-primary btn-block">Commander</button>
											</div>
											</div>
										</form>
										<?php } ?>
											</div>						
										</div>
									</section>
								</div>
							</div>
							<div class="col-md-3">
								<div class="hc_box_header_sup hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_new_offers_box_title">Mon portefeuille</h3>
												<center>Vous avez <?= $_SESSION['account']['gold']; ?> Point<?= $this->Many($_SESSION['account']['gold']); ?></center>
											</div>						
										</div>
									</section>
								</div>
								<button type="button" data-toggle="modal" data-target="#PrixDomain" class="btn btn-yellow btn-block">Prix des extensions</button>
							</div>
						</div>
					</div>
					<div class="page-footer">
						<p>Made with <i class="fa fa-heart"></i> by Arwantys</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="PrixDomain" tabindex="-1" role="dialog" aria-labelledby="PrixDomainLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="PrixDomainLabel">Prix des extensions</h4>
					</div>
					<div class="modal-body">
                    	<table class="table table-bordered">
							<thead>
								<tr>
									<th>Extension</th>
									<th>Prix</th>
								</tr>
							</thead>
							<tbody>
								<?php
								
								$Prix = $db->query('SELECT * FROM hc_lists_extensions');
								
								while($p = $Prix->fetch()) {
									echo '<tr>
									<td>'.$p['extension'].'</td>
									<td>'.$p['price'].' Point'.$this->Many($p['price']).'</td>
								</tr>';
								}
								
								?>
							</tbody>
						</table>                              
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>
		
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/jquery/jquery-3.1.0.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/ajax/order.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/space.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/pages/dashboard.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/loading.min.js"></script>

	</body>
</html>
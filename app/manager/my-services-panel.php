<?php

$db = MySQL::Database();

$SelectID = $db->prepare('SELECT * FROM hc_services WHERE id = ? AND sso = ?');
$SelectID->execute(array($get_id, $_SESSION['account']['sso']));
$rowCountID = $SelectID->rowCount();

if($rowCountID == 0) {
	header('Location: /Client/Services');
	exit();
} else {
	$fetchID = $SelectID->fetch();

	$Access = $db->prepare('SELECT * FROM hc_services_access WHERE name = ? AND extension = ? AND sso = ?');
	$Access->execute(array($fetchID['name'], $fetchID['extension'], $_SESSION['account']['sso']));
	$Acc = $Access->fetch();

	$Solution = $db->prepare('SELECT * FROM hc_solutions WHERE name = ?');
	$Solution->execute(array($fetchID['solution']));
	$Sol = $Solution->fetch();

	$SWF = $db->prepare('SELECT * FROM hc_services_swfs WHERE name = ? AND extension = ? AND sso = ?');
	$SWF->execute(array($fetchID['name'], $fetchID['extension'], $_SESSION['account']['sso']));
	$rowSWF = $SWF->rowCount();
	if($rowSWF != 0) {
		$fetchSWF = $SWF->fetch();
	}

	$Domains = $db->prepare('SELECT COUNT(*) AS nb FROM hc_services_domains WHERE name = ? AND extension = ? AND sso = ?');
	$Domains->execute(array($fetchID['name'], $fetchID['extension'], $_SESSION['account']['sso']));
	$Dom = $Domains->fetch();
}



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
								Information sur votre service et options<br>
								<p style="font-size: 24px; margin-top: -7px">Pack <?= $fetchID['solution']; ?></p>
							</div>
						<div class="row hc_container">
							
							 <div class="col-md-12">
								<div class="hc_box_header_sup hc_content_box" style="margin-top: -30px">
									<div class="hc_services_lists">
										<ul class="hc_services_ul">
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title">
														Numéro de service
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<?= $fetchID['id']; ?>
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title">
														Service commandé le
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<?= date("d-m-Y à H:i", strtotime($fetchID['created_at'])); ?>
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title">
														Expiration du service le
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<?= date("d-m-Y à H:i", strtotime($fetchID['expire_at'])); ?>
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title">
														État du service
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<?= $this->StatusServices($fetchID['status']); ?>
												</div>
											</li>
											<?php if($Sol['option_support_phone'] == 1) { ?>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title">
														Support téléphonique
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													07 56 88 41 59
												</div>
											</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div id="error"></div>
								<button id="hc_renouvellement" class="btn btn-blue btn-block">Renouveler mon rétro</button>
							</div>
							<div class="col-md-6">
								<div class="hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">Noms de domaine</h3>
												<ul class="hc_ul_panel">
													<li class="row hc_li_panel">
														<div class="col-md-5">
															Noms de domaine inclus
														</div>
														<div class="col-md-2">
															<?= $Dom['nb']; ?>
														</div>
														<div class="col-md-5">
															<a href="/Client/OrderDomain" style="font-size: 13px"><i class="fa fa-angle-right"></i> Commander un domaine</a>
														</div>
													</li>
												</ul>
												<center><a href="/Client/Services/<?= $fetchID['id']; ?>/Domain" class="btn btn-blue">Administrer</a></center>
											</div>						
										</div>
									</section>
								</div>
								<div class="hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">Hébergement</h3>
												<ul class="hc_ul_panel">
													<li class="row hc_li_panel">
														<div class="col-md-5">
															Espace Web
														</div>
														<div class="col-md-2">
															<?= $Sol['storage_disk']; ?> Go
														</div>
													</li>
													<li class="row hc_li_panel">
														<div class="col-md-5">
															Trafic illimité
														</div>
														<div class="col-md-2">
															Oui
														</div>
													</li>
													<li class="row hc_li_panel">
														<div class="col-md-5">
															Base de données MySQL
														</div>
														<div class="col-md-2">
															1
														</div>
													</li>
													<li class="row hc_li_panel">
														<div class="col-md-5">
															Accès FTP
														</div>
														<div class="col-md-2">
															1
														</div>
													</li>
													<li class="row hc_li_panel">
														<div class="col-md-5">
															SSL
														</div>
														<div class="col-md-2">
															<?php if($fetchID['ssl'] == 1) { echo 'Oui'; } else { echo 'Non'; } ?>
														</div>
													</li>
												</ul>
												<center><a href="/Client/Services/<?= $fetchID['id']; ?>/Hosting" class="btn btn-blue">Administrer</a></center>
											</div>						
										</div>
									</section>
								</div>
							</div>
							<div class="col-md-6">
								<div id="errorop"></div>
								<div class="hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">Options et services</h3>
												<ul class="hc_ul_panel">
													<li class="row hc_li_panel">
														<div class="col-md-6">
															Renouvellement automatique (bientôt)
														</div>
														<div class="col-md-2">
															<?php if($fetchID['self_renewal'] == 1) { echo '<span id= "ren_auto_t">Oui</span>'; } else { echo '<span id= "ren_auto_t">Non</span>'; } ?>
														</div>
														<div class="col-md-4">
															<?php if($fetchID['self_renewal'] == 1) { echo '<a href="#" id="hc_renouvellement_auto"><i class="fa fa-angle-right"></i> Désactiver</a>'; } else { echo '<a href="#" id="hc_renouvellement_auto"><i class="fa fa-angle-right"></i> Activer</a>'; } ?>
														</div>
													</li>
													<li class="row hc_li_panel">
														<div class="col-md-6">
															Pack SWF
														</div>
														<div class="col-md-2">
															<?php if($fetchID['swf'] == '1') { echo 'Oui'; } else { echo 'Non'; } ?>
														</div>
														<div class="col-md-4">
															<?php if($fetchID['swf'] == '1') { echo '<a href="/Client/Services/'.$fetchID['id'].'/SWF"><i class="fa fa-angle-right"></i> Gérer</a>'; } else { echo '<a id="hc_swf" href="#"><i class="fa fa-angle-right"></i> Commander</a>'; } ?>
														</div>
													</li>
													<li class="row hc_li_panel">
														<div class="col-md-6">
															Session VPS
														</div>
														<div class="col-md-2">
															<?php if($fetchID['session_vps'] == '1') { echo 'Oui'; } else { echo 'Non'; } ?>
														</div>
														<div class="col-md-4">
															<?php if($fetchID['session_vps'] == '1') { echo '<a href="#"><i class="fa fa-angle-right"></i> Gérer</a>'; } else { echo '<a href="#"><i class="fa fa-angle-right"></i> Commander</a>'; } ?>
														</div>
													</li>
												</ul>
											</div>						
										</div>
									</section>
								</div>
								<div class="hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">Résiliation</h3>
												<p>Vous souhaitez résilier votre service ?</p>
												<button class="btn btn-semi-blue">Résilier</button>
											</div>						
										</div>
									</section>
								</div>
								<div class="hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">Changement de Pack</h3>
												<p>Vous souhaitez faire évoluer votre service ? Renseignez-vous sur les possibilités de changement de pack.</p>
												<button class="btn btn-semi-blue">Voir les possibilités possibles</button>
											</div>						
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
					<div class="page-footer">
						<p>Made with <i class="fa fa-heart"></i> by Arwantys</p>
					</div>
				</div>
			</div>
		</div>
		
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/jquery/jquery-3.1.0.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/space.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/pages/dashboard.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/loading.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/ajax/notifications.js"></script>
		<script>
			var host = "<?php echo $Acc['mysql_host']; ?>";
			var user = "<?php echo $Acc['mysql_user']; ?>";
			var password = "<?php echo $Acc['mysql_password']; ?>";
			var database = "<?php echo $Acc['mysql_database']; ?>";
			var retroid = "<?php echo $fetchID['id']; ?>";
		</script>
		<script src="<?= $this->App('url'); ?>/app/ajax/panel.js"></script>
	</body>
</html>
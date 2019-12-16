<?php

$db = MySQL::Database();

$SelectID = $db->prepare('SELECT * FROM hc_services WHERE id = ? AND sso = ?');
$SelectID->execute(array($get_id, $_SESSION['account']['sso']));
$rowCountID = $SelectID->rowCount();

if($rowCountID == 0) {
	header('Location: /Client/Services');
} else {
	$fetchID = $SelectID->fetch();

	$Access = $db->prepare('SELECT * FROM hc_services_access WHERE name = ? AND extension = ? AND sso = ?');
	$Access->execute(array($fetchID['name'], $fetchID['extension'], $_SESSION['account']['sso']));
	$Acc = $Access->fetch();

	$Solution = $db->prepare('SELECT * FROM hc_solutions WHERE name = ?');
	$Solution->execute(array($fetchID['solution']));
	$Sol = $Solution->fetch();

	$Domains = $db->prepare('SELECT * FROM hc_services_domains WHERE name = ? AND extension = ? AND sso = ?');
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
							<a href="/Client/Services/<?= $fetchID['id']; ?>" style="color: #fff"><i class="fa fa-arrow-left "></i> <?= $fetchID['name'].$fetchID['extension']; ?></a>		
						</div>
						<div class="hc_header_menu">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#details" role="tab" data-toggle="tab" aria-expanded="true">Détails</a></li>
								<!--<li role="presentation" class=""><a href="#dns" role="tab" data-toggle="tab" aria-expanded="false">Paramètres DNS</a></li>-->
							</ul>
						</div>
						<div class="row hc_container tab-content" style="padding: 0px; margin-top: 0px; margin-left: 53px;">
							<div role="tabpanel" class="col-md-6 tab-pane active" id="details">
								<div class="hc_content_box" style="margin-top: 25px">
									<div class="hc_services_lists">
										<ul class="hc_services_ul">
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title" style="margin-left: 0px;">
														Statut
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<div class="pull-right" style="margin-right: 20px"><?= $this->StatusServices($Dom['status']); ?></div>										
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title" style="margin-left: 0px;">
														Commandé le
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<div class="pull-right" style="margin-right: 20px"><?= date("d-m-Y à H:i", strtotime($Dom['order_at'])); ?></div>										
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title" style="margin-left: 0px;">
														Expire le
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<div class="pull-right" style="margin-right: 20px"><?= date("d-m-Y à H:i", strtotime($Dom['expire_at'])); ?></div>										
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title" style="margin-left: 0px;">
														Dernière mise à jour le
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<div class="pull-right" style="margin-right: 20px"><?= date("d-m-Y à H:i", strtotime($Dom['last_update'])); ?></div>										
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title" style="margin-left: 0px;">
														DNS1
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<div class="pull-right" style="margin-right: 20px"><?= $Dom['dns1']; ?></div>										
												</div>
											</li>
											<li class="hc_services_1 hc_services_2 hc_services_3 hc_services_4 hc_services_5 hc_services_6 hc_services_7 hc_services_8 hc_services_9 hc_services_10">
												<div class="col-md-6">
													<div class="hc_services_title" style="margin-left: 0px;">
														DNS2
													</div>
												</div>
												<div class="col-md-6" style="color: #646e80">
													<div class="pull-right" style="margin-right: 20px"><?= $Dom['dns2']; ?></div>										
												</div>
											</li>
										</ul>
									</div>
								</div>
								<!--<button class="btn btn-semi-blue btn-block">Renouveller</button>-->
							</div>
							<!--<div role="tabpanel" class="col-md-6 tab-pane" id="dns">
								dns
							</div>-->
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
	</body>
</html>
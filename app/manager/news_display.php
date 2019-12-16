<?php

$db = MySQL::Database();

$Recovery = $db->prepare('SELECT * FROM hc_news WHERE id = ?');
$Recovery->execute(array($get_id));
$rowCount = $Recovery->rowCount();

if($rowCount == 0) {
	header('Location: /Client/News');
} else {
	$fetch = $Recovery->fetch();
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
								Actualités
							</div>
						<div class="row hc_container">
							<div class="col-md-8">
								<div class="hc_box_header_sup hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<?php
												
												$db = MySQL::Database();
												
												$News = $db->prepare('SELECT * FROM hc_news WHERE id = ? ORDER BY created_at DESC LIMIT 1');
												$News->execute(array($get_id));
												while($N = $News->fetch()) {
													echo '<h3 class="hc_panel_box_title">'.$N['title'].'<div style="font-size: 13px" class="pull-right">Posté le '.date("d-m-Y à H:i", strtotime($N['created_at'])).'</div></h3>
														<p>'.wordwrap($N['content'], 45, "\n", true).'</p>
													';
												}
												
												?>
											</div>						
										</div>
									</section>
								</div>
							</div>
							<div class="col-md-4">
								<div class="hc_box_header_sup hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_panel_box">
												<h3 class="hc_panel_box_title">Listes des articles</h3>
												<div class="hc_card_lists">
												<ul>
													<?php
													
													$Select = $db->query('SELECT * FROM hc_news ORDER BY created_at DESC LIMIT 20');
													
													while($S = $Select->fetch()) {
														echo '<li>
																<a href="/Client/News/'.$S['id'].'">
																	<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
																	<span class="hc_card_content">'.$S['title'].'</span>
																</a>
															</li>';
													}
													
													?>
												</ul>
											</div>
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
	</body>
</html>
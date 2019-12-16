
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
								Équipe
							</div>
						<div class="row hc_container">
							<div style="margin-top: -20px">
							<div class="col-md-4">
								<div class="hc_panel">
							   		<div class="hc_panel_title_admin">
										Administrateurs
									</div>
									<div class="hc_panel_body">
										<div class="hc_panel_bloc">
											<?php
											
											$db = MySQL::Database();
											
											$Dev = $db->query('SELECT username, avatar, rank, mood FROM hc_users WHERE rank = 8');
											
											$rowCount = $Dev->rowCount();
											
											if($rowCount == 0) {
												echo '<div class="hc_panel_members">
													Nous n\'avons aucun administrateur
														</div>';
											} else {
											
												while($A = $Dev->fetch()) {
													echo '<div class="hc_panel_members">
													<img class="hc_panel_avatar" src="'.$A['avatar'].'">
													<div class="hc_panel_username">
														<span class="'.$this->Rank($A['rank'], 'color').'">'.$A['username'].'</span>
														</div>
														<div class="hc_panel_mood">
														'.$A['mood'].'
														</div>
														</div>';
												}
											}
											?>
										</div>
									</div>
							   	</div>
							   <div class="hc_panel">
							   		<div class="hc_panel_title_tech">
										Techniciens
									</div>
									<div class="hc_panel_body">
										<div class="hc_panel_bloc">
											<?php
											
											$db = MySQL::Database();
											
											$Dev = $db->query('SELECT username, avatar, rank, mood FROM hc_users WHERE rank = 5');
											
											$rowCount = $Dev->rowCount();
											
											if($rowCount == 0) {
												echo '<div class="hc_panel_members">
													Nous n\'avons aucun technicien
														</div>';
											} else {
											
												while($A = $Dev->fetch()) {
													echo '<div class="hc_panel_members">
													<img class="hc_panel_avatar" src="'.$A['avatar'].'">
													<div class="hc_panel_username">
														<span class="'.$this->Rank($A['rank'], 'color').'">'.$A['username'].'</span>
														</div>
														<div class="hc_panel_mood">
														'.$A['mood'].'
														</div>
														</div>';
												}
											}
											?>
										</div>
									</div>
							   	</div>
							   <div class="hc_panel" style="margin-bottom: 15px">
							   		<div class="hc_panel_title_assistant">
										Assistants
									</div>
									<div class="hc_panel_body">
										<div class="hc_panel_bloc">
											<?php
											
											$db = MySQL::Database();
											
											$Resp = $db->query('SELECT username, avatar, rank, mood FROM hc_users WHERE rank = 4');
											
											$rowCount = $Resp->rowCount();
											
											if($rowCount == 0) {
												echo '<div class="hc_panel_members">
													Nous n\'avons aucun assistant
														</div>';
											} else {
											
												while($A = $Resp->fetch()) {
													echo '<div class="hc_panel_members">
													<img class="hc_panel_avatar" src="'.$A['avatar'].'">
													<div class="hc_panel_username">
														<span class="'.$this->Rank($A['rank'], 'color').'">'.$A['username'].'</span>
														</div>
														<div class="hc_panel_mood">
														'.$A['mood'].'
														</div>
														</div>';
												}
											}
											?>
										</div>
									</div>
							   	</div>
							</div>
							<div class="col-md-4">
								<div class="hc_panel">
							   		<div class="hc_panel_title_dev">
										Développeurs
									</div>
									<div class="hc_panel_body">
										<div class="hc_panel_bloc">
											<?php
											
											$db = MySQL::Database();
											
											$Dev = $db->query('SELECT username, avatar, rank, mood FROM hc_users WHERE rank = 7');
											
											$rowCount = $Dev->rowCount();
											
											if($rowCount == 0) {
												echo '<div class="hc_panel_members">
													Nous n\'avons aucun développeur
														</div>';
											} else {
											
												while($A = $Dev->fetch()) {
													echo '<div class="hc_panel_members">
													<img class="hc_panel_avatar" src="'.$A['avatar'].'">
													<div class="hc_panel_username">
														<span class="'.$this->Rank($A['rank'], 'color').'">'.$A['username'].'</span>
														</div>
														<div class="hc_panel_mood">
														'.$A['mood'].'
														</div>
														</div>';
												}
											}
											?>
										</div>
									</div>
							   	</div>
								<div class="hc_panel" style="margin-bottom: 15px">
							   		<div class="hc_panel_title_resp">
										Responsables
									</div>
									<div class="hc_panel_body">
										<div class="hc_panel_bloc">
											<?php
											
											$db = MySQL::Database();
											
											$Resp = $db->query('SELECT username, avatar, rank, mood FROM hc_users WHERE rank = 6');
											
											$rowCount = $Resp->rowCount();
											
											if($rowCount == 0) {
												echo '<div class="hc_panel_members">
													Nous n\'avons aucun responsable
														</div>';
											} else {
											
												while($A = $Resp->fetch()) {
													echo '<div class="hc_panel_members">
													<img class="hc_panel_avatar" src="'.$A['avatar'].'">
													<div class="hc_panel_username">
														<span class="'.$this->Rank($A['rank'], 'color').'">'.$A['username'].'</span>
														</div>
														<div class="hc_panel_mood">
														'.$A['mood'].'
														</div>
														</div>';
												}
											}
											?>
										</div>
									</div>
							   	</div>
							</div>
							<div class="col-md-4">
								<div class="hc_panel">
							   		<div class="hc_panel_title_apropos">
										<i class="fa fa-info-circle"></i> À Propos
									</div>
									<div class="hc_panel_body">
										<div class="hc_panel_bloc">
											<div class="hc_panel_members" style="font-size: 13px;">
												<b>Les administrateurs</b> s'occupent de la stabilité des serveurs, de leurs bon fonctionnement, de la livraison des rétros-habbo et de vos tickets.<br><br>
												<b>Les développeurs</b> sont chargés d’écrire tout ou partie des programmes informatiques nécessaires à la bonne marche d'Habbo Cloud.<br><br>
												<b>Les responsables</b> s'occupent d'une équipe en particulier, des recrutements à leur bonne gestion.<br><br>
												<b>Les techniciens</b> s'occupent de la livraison des rétros ainsi que de vos problèmes liés à celui-ci.<br><br>
												<b>Les assistants</b> vous aides sur la Chatbox et répondent à vos tickets.
											</div>
										</div>
									</div>
							   	</div>
					
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
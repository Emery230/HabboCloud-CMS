
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
								Consulter mes tickets
							</div>
						<div class="row hc_container">
							<div class="col-md-9">
								<div class="hc_box_header_sup hc_content_box" style="margin-top: -20px">
									<table class="hc_tables">
										<thead>
											<tr class="hc_tables_header">
												<th class="hc_tables_th hc_tables_col_1_suivi">Sujet</th>
												<th class="hc_tables_th hc_tables_col_2_suivi" style="width: 150px">État</th>
												<th class="hc_tables_th hc_tables_col_2_suivi" style="width: 150px">Ouvert le</th>
												<th class="hc_tables_th hc_tables_col_2_suivi" style="width: 115px">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
												
										$db = MySQL::Database();
												
										if(isset($_SESSION['account']['sso'])) {
											$Tickets = $db->prepare('SELECT * FROM hc_support WHERE sso = ? ORDER BY status LIMIT 100');
											$Tickets->execute(array($_SESSION['account']['sso']));
											
											$rowCount = $Tickets->rowCount();
											
											if($rowCount == 0) {
												echo '<tr class="hc_tables_tbody_tr">
												<td class="hc_tables_tbody_th_first">
													Vous n\'avez aucun ticket
												</td>
												<td class="hc_tables_tbody_th_two" style="width: 150px">
													
												</td>
												<td class="hc_tables_tbody_th_two" style="width: 150px">
													
												</td>
												<td class="hc_tables_tbody_th_two" style="width: 115px">
													
												</td>
											</tr>';
											} else {
												
											
													
											while($T = $Tickets->fetch()) { ?>
											<tr class="hc_tables_tbody_tr">
												<td class="hc_tables_tbody_th_first">
													<?= $T['sujet']; ?>
												</td>
												<td class="hc_tables_tbody_th_two" style="width: 150px">
													<?= $this->StatusSupport($T['status']); ?>
												</td>
												<td class="hc_tables_tbody_th_two" style="width: 150px">
													<?= date("d-m-Y", strtotime($T['created_at'])); ?>
												</td>
												<td class="hc_tables_tbody_th_two" style="width: 115px">
													<a href="/Client/Support/<?= $T['id']; ?>">Voir</a>
												</td>
											</tr>
										<?php } } } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-3" style="margin-top: -20px">
								<a href="/Client/Support/Create" class="btn btn-yellow btn-block">Créer un ticket</a>
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
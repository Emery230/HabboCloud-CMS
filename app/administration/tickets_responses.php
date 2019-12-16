<?php

$db = MySQL::Database();
 

$RecoveryID = $db->prepare('SELECT * FROM hc_support WHERE id = ?');
$RecoveryID->execute(array($get_id));
$rowCountID = $RecoveryID->rowCount();

if($rowCountID == 0) {
	header('Location: /administration/tickets');
    exit();
} else {
	$fetchID = $RecoveryID->fetch();
	
	$InfoAccount = $db->prepare('SELECT username, avatar, rank, sso FROM hc_users WHERE sso = ?');
	$InfoAccount->execute(array($fetchID['sso']));
	$fetchAccount = $InfoAccount->fetch();
}

?>
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
	<style>
		.hc_support {
			max-height: 390px;
			margin: 0 auto 5px auto;
			overflow: auto;
			overflow-y: scroll;
		}
	</style>
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
						<div class="col-lg-12">
							<div class="ibox ibox-fullheight">
								<div class="ibox-head">
									<div class="ibox-title"><?= $fetchID['sujet']; ?></div>
								</div>
								<div class="ibox-body">
									<div class="ibox-fullwidth-block">
										<div class="row">
											<div class="col-md-12 hc_support" style="padding: 0px 25px 0px 25px">
												<ul class="media-list media-list-divider m-0">
													<?php
													
													$Responses = $db->prepare('SELECT * FROM hc_support_responses WHERE ticket_id = ? ORDER BY added_at DESC');
													$Responses->execute(array($get_id));
													
													while($R = $Responses->fetch()) {
														$Account = $db->prepare('SELECT username, rank, avatar, sso FROM hc_users WHERE sso = ?');
														$Account->execute(array($R['sso']));
														$fetch = $Account->fetch();
														
														echo '<li class="media"><a class="media-img" href="javascript:;"><img class="img-circle" src="'.$fetch['avatar'].'" width="40px"></a>
														<div class="media-body">
															<div class="media-heading"><span class="'.$this->Rank($fetch['rank'], 'color').'">'.$fetch['username'].'</span> <small class="float-right text-muted">'.$this->ConvertTime($R['added_at']).'</small></div>
															<div class="font-13">'.wordwrap($R['reply'], 45, "\n", true).'</div>
														</div>
													</li>';
													}
													
													?>
													<li class="media"><a class="media-img" href="javascript:;"><img class="img-circle" src="<?= $fetchAccount['avatar']; ?>" width="40px"></a>
														<div class="media-body">
															<div class="media-heading"><span class="<?= $this->Rank($fetchAccount['rank'], 'color'); ?>"><?= $fetchAccount['username']; ?></span> <small class="float-right text-muted"><?= $this->ConvertTime($fetchID['created_at']); ?></small></div>
															<div class="font-13"><?=  wordwrap($fetchID['content'], 45, "\n", true); ?></div>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<div id="error"></div>
							<div class="ibox ibox-fullheight">
								<div class="ibox-body">
									<form id="hc_ticket_add">
										<div class="form-group">
											<label>Réponse</label>
											<textarea id="reply" class="form-control" name="reply" rows="3"></textarea>
										</div>
										<button style="float: left; margin-right: 10px"class="btn btn-primary">Envoyer</button>
									</form>
									<button id="hc_close_ticket" class="btn btn-danger">Fermer le ticket</button>
								</div>
							</div>
						</div>
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
		<script>var idticket = "<?= $get_id; ?>"</script>
		<script src="<?= $this->App('url'); ?>/app/administration/ajax/tickets_add.js" type="text/javascript"></script>
	</body>
</html>
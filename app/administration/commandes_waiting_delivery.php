<?php

$db = MySQL::Database();


$Recovery = $db->prepare('SELECT * FROM hc_orders WHERE id = ?');
$Recovery->execute(array($get_id));
$rowCount = $Recovery->rowCount();

if($rowCount == 0) {
	header('Location: /administration/commandes/waiting');
    exit();
} else {
	$fetch = $Recovery->fetch();
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
							<div id="error"></div>
							<div class="ibox ibox-fullheight">
								<div class="ibox-head">
									<div class="ibox-title">Livraison commande #<?= $fetch['id']; ?></div>
								</div>
								<div class="ibox-body" style="padding: 35px">
									<div class="ibox-fullwidth-block">
										<form id="hc_order_waiting">
											<div class="row">
												<div class="col-md-4">
													Nom: <strong><?= $fetch['name']; ?></strong><br>
													Extension: <strong><?= $fetch['extension']; ?></strong><br>
													Solution: <strong><?= $fetch['solution']; ?></strong><br>
													CMS: <strong><?= $fetch['cms']; ?></strong><br>
													Émulateur: <strong><?= $fetch['emulator']; ?></strong>
												</div>
												<div class="col-md-4 form-group">
													<label>Hôte MySQL</label>
													<input class="form-control" type="text" name="host_mysql" placeholder="Hôte MySQL">
													<label>Utilisateur MySQL</label>
													<input class="form-control" type="text" name="user_mysql" placeholder="Utilisateur MySQL">
													<label>Mot de passe MySQL</label>
													<input class="form-control" type="text" name="password_mysql" placeholder="Mot de passe MySQL">
													<label>Base de données MySQL</label>
													<input class="form-control" type="text" name="database_mysql" placeholder="Hôte MySQL">
												</div>
												<div class="col-md-4 form-group">
													<label>Hôte FTP</label>
													<input class="form-control" type="text" name="host_ftp" placeholder="Hôte FTP">
													<label>Utilisateur FTP</label>
													<input class="form-control" type="text" name="user_ftp" placeholder="Utilisateur FTP">
													<label>Mot de passe FTP</label>
													<input class="form-control" type="text" name="password_ftp" placeholder="Mot de passe FTP">
												</div>
												<div class="col-md-12">
													<button class="btn btn-primary btn-block">Valider la commande</button>
												</div>
											</div>
										</form>
										<button id="hc_order_refund" style="margin-top: 10px" class="btn btn-danger btn-block">Nom de domaine déjà utilisé (Remboursement)</button>
									</div>
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
		<script>var name = "<?= $fetch['name']; ?>"; var extension = "<?= $fetch['extension']; ?>"; var solution = "<?= $fetch['solution']; ?>"; var cms = "<?= $fetch['cms']; ?>"; var emulator = "<?= $fetch['emulator']; ?>"; var sso = "<?= $fetch['sso']; ?>"</script>
		<script src="<?= $this->App('url'); ?>/app/administration/ajax/order.js" type="text/javascript"></script>
	</body>
</html>
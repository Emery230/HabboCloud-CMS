<?php

$db = MySQL::Database();

$RecoveryID = $db->prepare('SELECT * FROM hc_support WHERE id = ? AND sso = ?');
$RecoveryID->execute(array($get_id, $_SESSION['account']['sso']));
$IDRowCount = $RecoveryID->rowCount();

if($IDRowCount == 0) {
	header('Location: /Client/Support');
} else {
	$IDFetch = $RecoveryID->fetch();
	$InfoAccount = $db->prepare('SELECT username, avatar, rank, sso FROM hc_users WHERE sso = ?');
	$InfoAccount->execute(array($IDFetch['sso']));
	$AccountFetch = $InfoAccount->fetch();
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
								Ticket #<?= $IDFetch['id']; ?>
							</div>
						<div class="row hc_container">
							<div class="col-md-12"><div id="error"></div></div>
                            <div class="col-md-12" style="margin-top: -20px">
								<div class="hc_panel">
							   		<div class="hc_panel_title_sondage">
										<i class="fa fa-comments"></i> <?= $IDFetch['sujet']; ?>
										<div class="pull-right"><span style="background-color: #fff; padding: 4px; border-radius: 6px;"><?= $this->StatusSupport($IDFetch['status']); ?></span></div>
									</div>
									<div class="hc_panel_body">
										<div class="hc_panel_bloc">
											<div class="hc_panel_info hc_support">
												<?php
										
										$Responses = $db->prepare('SELECT * FROM hc_support_responses WHERE ticket_id = ? ORDER BY added_at DESC');
										$Responses->execute(array($get_id));
										$rowCount = $Responses->rowCount();
										if($rowCount > 0) {
										while($R = $Responses->fetch()) {
											$Account = $db->prepare('SELECT username, avatar, rank, sso FROM hc_users WHERE sso = ?');
											$Account->execute(array($R['sso']));
											$fetchAccount = $Account->fetch();
											echo '<div class="email">
											<div class="email-header">
												
												<div class="email-author">
													<img src="'.$fetchAccount['avatar'].'" alt="">
													<span class="author-name '.$this->Rank($fetchAccount['rank'], 'color').'">'.$fetchAccount['username'].'</span>
													<span class="email-date">'.$this->ConvertTime($R['added_at']).'</span>
												</div>
												<span class="divider"></span>
											</div>
											<div class="email-body">
												<span>
													'.strip_tags(htmlspecialchars_decode(wordwrap($R['reply'], 45, "\n", true))).'
												</span>
											</div>
										</div>';
										}
																								  }
										?>
										<div class="email">
											<div class="email-header">
												<div class="email-author">
													<img src="<?= $AccountFetch['avatar']; ?>" alt="">
													<span class="author-name <?= $this->Rank($AccountFetch['rank'], 'color'); ?>"><?= $AccountFetch['username']; ?></span>
													<span class="email-date"><?= $this->ConvertTime($IDFetch['created_at']); ?></span>
												</div>
												<span class="divider"></span>
											</div>
											<div class="email-body">
												<span>
													<?=  wordwrap($IDFetch['content'], 45, "\n", true); ?>
												</span>
											</div>
										</div>
											</div>
										</div>
									</div>
								</div>
								
								<?php if($IDFetch['status'] != 'close') { ?>
								<div class="email-reply">
									<form id="hc_reply">
										<textarea id="reply" name="reply" class="form-control" placeholder="Exprimez-vous..."></textarea>
										<div style="margin-top: 8px;" class="pull-right"><button class="btn btn-primary">Répondre</button></div>
									</form>
								</div>
								<?php } ?>
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
		<script>var idticket = "<?= $get_id; ?>"</script>
		<script src="<?= $this->App('url'); ?>/app/ajax/support.js"></script>
	</body>
</html>
<?php

$db = MySQL::Database();

$ShoutboxSettings = $db->query('SELECT * FROM hc_shoutbox_settings');
$SettingsShoutbox = $ShoutboxSettings->fetch();

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
		<link rel="stylesheet" type="text/css" href="<?= $this->App('url'); ?>/vendor/zuck.js-master/zuck.css">
	<link rel="stylesheet" type="text/css" href="<?= $this->App('url'); ?>/vendor/zuck.js-master/skins/snapssenger.css">
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
								Chatbox <i class="fa fa-american-sign-language-interpreting"></i>
							</div>
						<div class="row hc_container">
							<div class="col-md-8">
								<div style="margin-bottom: 70px" class="hc_box_header_sup hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">
													Stories
													<?php if($_SESSION['account']['rank'] >= 2) { ?>
													<a href="#" class="pull-right" data-toggle="modal" data-target="#AddStorie">Ajouter une storie</a>
													<?php } ?>
												</h3>
												<div id="stories"></div>
											</div>						
										</div>
									</section>
								</div>
								<div id="error"></div>
								<div class="hc_box_header_sup hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">
													<?php if($SettingsShoutbox['announcement_status'] == 'active') { ?>
													<div style="font-size: 14px;background-color: #599ede;color: #fff;padding: 5px 5px 5px 0px;text-align: center;margin-bottom: 12px;"><?= $SettingsShoutbox['announcement_message']; ?></div>
													<?php } ?> 
													Discussion
													<div class="pull-right"><div id="status_shout"></div></div>
												</h3>
												<?php if($SettingsShoutbox['chatbox_status'] == 'active') { ?>
												<form id="shoutboxmsg">
													<div class="input-group">
														<input type="text" id="message" placeholder="Exprimez-vous" class="form-control">
														<span class="input-group-btn">
															<button type="submit" id="send" class="btn btn-primary xs-mb">Envoyer</button>
														</span>
													</div>
												</form>
												<div class="habbo-cloud-shoutbox">
													<section id="typing"></section>
													<div class="shoutbox">
														<div id="messages">
															<div id="msgtpl" style="display:none">
																<div class="shout">
																	<ul class="chat" id="affichage_chat">
																		<script>if(<?php echo $_SESSION['account']['id']; ?> != {{user.id}} ) { $('#affichage_chat').html('<li class="chat__bubble chat__bubble--rcvd chat__bubble--stop"><img class="avatar_shoutbox" src="{{user.avatar}}"><span  class="' + RankGroupe(+'{{user.rank}}') + '">{{user.username}}</span> <span style="opacity: 1;"  onclick="Tag(\'{{user.username}}\')" id="tagShoutbox"></span> <small>{{h}}:{{m}}</small> : {{message}}</li>'); } else { 	$('#affichage_chat').html('<li class="chat__bubble chat__bubble--sent"><small>{{h}}:{{m}}</small> : {{message}}</li>'); } </script>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php } elseif($SettingsShoutbox['chatbox_status'] == 'maintenance') { ?>
												<hr>
												<center><i style="color: #2063a2" class="fa fa-wrench"></i> La Chatbox est actuellement en maintenance, des nouveautés sont en cours d'installation</center>
												<?php } elseif($SettingsShoutbox['chatbox_status'] == 'disabled') { ?>
												<hr>
												<center><i style="color: red" class="fa fa-warning"></i> Oups, malheureusement la Chatbox est désactivé</center>
												<?php } ?>
												
											</div>						
										</div>
									</section>
								</div>
							</div>
							<div class="col-md-4">
								<div class="hc_box_header_sup hc_content_box">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">Membres en ligne</h3>
												<div id="users"></div>
											</div>						
										</div>
									</section>
								</div>

								<div class="hc_content_box" style="">
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_new_offers_box">
												<h3 class="hc_panel_box_title">Classement</h3>
												<div>
													<?php
													
													$i = 1;
													$Chatbox = $db->query('SELECT * , count(message) as nbr FROM hc_shoutbox GROUP BY user_id ORDER BY nbr DESC LIMIT 3');
													while($c = $Chatbox->fetch()) {
													$count = $db->prepare('SELECT COUNT(*) AS nb FROM hc_shoutbox WHERE user_id = ?');
													$count->execute(array($c['user_id']));
													$countf = $count->fetch();
													
														$account = $db->prepare('SELECT * FROM hc_users WHERE id = ?');
													$account->execute(array($c['user_id']));
													$accountf= $account->fetch();
													?>
													
													<span style="margin-top: 16px;"><i class="fa fa-trophy" style="color: <?php if($i == 1) { echo '#f0cc00'; } elseif($i == 2) { echo '#C0C0C0'; } elseif($i == 3) { echo '#cd7f32'; }; ?>"></i> - <span class="<?= $this->Rank($accountf['rank'], 'color'); ?>"><?= $accountf['username']; ?></span> <div class="pull-right" style="color: <?php if($i == 1) { echo '#f0cc00'; } elseif($i == 2) { echo '#C0C0C0'; } elseif($i == 3) { echo '#cd7f32'; }; ?>; font-weight: bold;"><?= $countf['nb']; ?> Message<?= $this->Many($countf['nb']); ?></div></span><br>
													<?php $i++; } ?>
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
		<?php if($_SESSION['account']['rank'] >= 2) { ?>
		<div class="modal fade" id="AddStorie" tabindex="-1" role="dialog" aria-labelledby="AddStorieLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="AddStorieLabel">Ajouter une storie</h4>
					</div>
					<div class="modal-body">
						<form  enctype="multipart/form-data" class="form-horizontal" id="a_add_storie">
							<input type="file" name="storie" class="form-control"/>
							<br/>
							<button name="addstorie" type="submit" class="btn btn-primary btn-block">Ajouter dans ma storie</button>
						</form>                 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/jquery/jquery-3.1.0.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/space.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/pages/dashboard.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/loading.min.js"></script>
		<script src="<?= $this->App('url'); ?>/app/ajax/notifications.js"></script>
		<script>
			$(document).ready(function() {
			 $('#a_add_storie').on('submit', function(e) {
				 e.preventDefault();
				 
				 $.ajax({
					 url: '/system/ajax/add_storie',
					 type: "POST",             
					 data: new FormData(this),
					 contentType: false,      
					 cache: false,             
					 processData:false,        
					 success: function(data)   
					 {
						 
						 document.location.href = "/Client/Chatbox";
					 }
				 });
			 });
		});
		</script>
		<script src="<?= $this->App('url'); ?>/vendor/zuck.js-master/zuck.js"></script>
		<script>
			function buildItem(id, type, length, src, preview, link, seen, time) {

				return {
					id,
					type,
					length,
					src,
					preview,
					link,
					seen,
					time,
				};
			}

			const stories = new Zuck('stories', {
				backNative: true,
				autoFullScreen: 'false',
				skin: 'snapssenger',
				avatars: 'true',
				list: false,
				cubeEffect: 'true',
				localStorage: true,
				stories: [
					<?php 
					
					$stories = $db->query('SELECT * FROM hc_stories');
					
					while($s = $stories->fetch()) {
						$account = $db->prepare('SELECT sso, avatar, rank, username FROM hc_users WHERE sso = ?');
						$account->execute(array($s['sso']));
						$fetch_a = $account->fetch();
						echo "
						{
						id: 'vision".$s['id']."',
						photo: 'https://habbo.cloud".$fetch_a['avatar']."',
						name: '".$fetch_a['username']."',
						link: '',
						lastUpdated: ".$s['date'].",
						items: [";
							$s_photos = $db->prepare('SELECT * FROM hc_stories_photos WHERE storie_id = ?');
							$s_photos->execute(array($s['id']));
							while($se = $s_photos->fetch()) {
								echo "buildItem('".$se['id']."', 'photo', 3, '".$se['photo']."', '', '', false, ".$se['date']."),";
							}
						
						echo "],
					},
					";
					}
					
					?>
				],
			});
		</script>
		<?php if($_SESSION['account']['username'] == 'Arwantys') { ?>
		<?php } ?>
		<script src="<?= $this->App('url'); ?>/app/shoutbox/mustache.js"></script>
		<script src="https://shoutbox.habbo.cloud:8080/socket.io/socket.io.js"></script>
		<script src="<?= $this->App('url'); ?>/app/shoutbox/client.js"></script>
		<script>var UsernameSession = "<?= $_SESSION['account']['username']; ?>";</script>
		<script>startTchat(<?= $_SESSION['account']['id']; ?>, "<?= $_SESSION['account']['sso']; ?>");</script>
	</body>
</html>
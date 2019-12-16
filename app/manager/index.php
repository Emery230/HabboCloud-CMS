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
                <div class="page-inner" style="margin-top: 20px">
                    <div id="main-wrapper">
                        <div class="row hc_container">
							<!--<div>
								<div class="k-ball-holder3">
									<div class="k-ball7a" ></div>
									<div class="k-ball7b" ></div>
									<div class="k-ball7c" ></div>
									<div class="k-ball7d" ></div>
								</div>	
							</div>-->
							<div class="col-md-4">
								<div class="hc_content_box">
									<div class="hc_box_title">
										<a href="/Client/Services" class="hc_box_header">
											<span class="hc_header_before">
												<span class="hc_before_icon"><i class="fa fa-briefcase"></i></span>
											</span>
											<span class="hc_header_text">Services</span>
											<span class="hc_header_after">
												<span class="hc_after_icon"><i class="material-icons hc_size_icon">keyboard_arrow_right</i></span>
											</span>
										</a>
									</div>
									<section class="hc_box_section">
										<div class="hc_section_card">
											<h3 class="hc_card_title">Mes services</h3>
											<div class="hc_card_lists">
												<ul>
													<li>
														<a href="/Client/Services">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Gérer mes services</span>
														</a>
													</li>
													<li>
														<a href="/Client/Order">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Commander un nouveau service</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</section>
								</div>
								<div class="hc_content_box">
									<div class="hc_box_title">
										<a href="/Client/Services" class="hc_box_header">
											<span class="hc_header_before">
												<span class="hc_before_icon"><i class="fa fa-plus"></i></span>
											</span>
											<span class="hc_header_text">Divers</span>
											<span class="hc_header_after">
												<span class="hc_after_icon"><i class="material-icons hc_size_icon">keyboard_arrow_right</i></span>
											</span>
										</a>
									</div>
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_card_lists">
												<ul>
													<li>
														<a href="/Client/Reloading">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Recharger mon compte</span>
														</a>
													</li>
													<li>
														<a href="/Client/Chatbox">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Chatbox</span>
														</a>
													</li>
													<li>
														<a href="/Client/News">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Actualités</span>
														</a>
													</li>
													<li>
														<a href="/Client/Surveys">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Sondages</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</section>
								</div>
							</div>
							<div class="col-md-4">
								<div class="hc_content_box">
									<div class="hc_box_title">
										<a href="/Client/Help" class="hc_box_header">
											<span class="hc_header_before">
												<span class="hc_before_icon"><i class="fa fa-question-circle"></i></span>
											</span>
											<span class="hc_header_text">Aides</span>
											<span class="hc_header_after">
												<span class="hc_after_icon"><i class="material-icons hc_size_icon">keyboard_arrow_right</i></span>
											</span>
										</a>
									</div>
									<section class="hc_box_section">
										<div class="hc_section_card">
											<h3 class="hc_card_title">Support</h3>
											<div class="hc_card_lists">
												<ul>
													<li>
														<a href="/Client/Support">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Consulter mes tickets</span>
														</a>
													</li>
													<li>
														<a href="/Client/Support/Create">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Ouvrir un ticket</span>
														</a>
													</li>
												</ul>
											</div>
											<h3 class="hc_card_title">Autres</h3>
											<div class="hc_card_lists">
												<ul>
													<li>
														<a href="/Client/FAQ">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Foire au questions</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</section>
								</div>
								<div class="hc_content_box">
									<div class="hc_box_title">
										<a href="/Client/Recruitment" class="hc_box_header">
											<span class="hc_header_before">
												<span class="hc_before_icon"><i class="fa fa-certificate"></i></span>
											</span>
											<span class="hc_header_text">Recrutement</span>
											<span class="hc_header_after">
												<span class="hc_after_icon"><i class="material-icons hc_size_icon">keyboard_arrow_right</i></span>
											</span>
										</a>
									</div>
									<section class="hc_box_section">
										<div class="hc_section_card">
											<div class="hc_card_lists">
												<ul>
													<li>
														<a href="/Client/Recruitment">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Session 2018</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</section>
								</div>
							</div>
							<div class="col-md-4">
								<div class="hc_content_box">
									<div class="hc_box_title">
										<a href="/Client/New_Offers" class="hc_box_header">
											<span class="hc_header_before">
												<span class="hc_before_icon"><i class="fa fa-star"></i></span>
											</span>
											<span class="hc_header_text_annonce">Les nouvelles offres<br> disponible</span>
											<span class="hc_header_after">
												<span class="hc_after_icon"><i class="material-icons hc_size_icon">keyboard_arrow_right</i></span>
											</span>
										</a>
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
		<script>
			function NewOffersLoading() {
				$("#newsoffers").load("/Divers/New_Offers")
			}

			$(document).ready(function() {
				NewOffersLoading()
			});	
		</script>
    </body>
</html>
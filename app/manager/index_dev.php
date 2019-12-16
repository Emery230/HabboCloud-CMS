
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $this->App('name'); ?> - Espace client</title>

        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
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
	<style>
		@import url('https://fonts.googleapis.com/css?family=Open+Sans');
		@import url('https://fonts.googleapis.com/css?family=Lato:300');
		
		body, .page-container {
			font-family: 'Open Sans', sans-serif;
		}
		
		.navbar-inverse .navbar-toggle:focus, .navbar-inverse .navbar-toggle:hover {
			background-color: transparent;
		}
		
		.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
			background-color: transparent;
			color: #fff;
		}
		
		.notifications {
		    background: #d35453;
			color: #fff;
			border-radius: 7.5px;
			display: block;
			position: absolute;
			font-size: 10px;
			line-height: 15px;
			width: auto;
			min-width: 15px;
			max-width: 30px;
			overflow: hidden;
			height: 15px;
			padding: 0 5px;
			margin-top: -44px;
			left: 27.5px;
			
		}
		
		.espace_client_title {
			font-family: 'Lato', sans-serif;
			padding: 25px;
			font-size: 23px; 
			color: #fff!important;
		}
		
		.hc_logo {
			border: 1px solid #fff;
			padding: 3px;
			margin-right: 4px;
		}
		
		.hc_navig_responsible {
			color: #fff;
			font-size: 27px;
		}
		
		.hc_dropdown_notifications {
			margin-right: -22px;
		}
		
		.hc_dropdown_menu {
			margin-right: 12px
		}
		
		.hc_new_navig {
			position: absolute; background-color: #1c3596; border-color: #1c3596; min-height: 70px;
		}
		
		.hc_button_responsible {
			border-color: transparent!important;
		}
		
		.hc_icon_bar {
			padding: 12px;
			font-size: 25px;
			color: #b1c1d0;
		}
		
		.hc_container {
			margin: 5px;
		}
		
		.hc_content_box {
			background-color: #fff;
			box-shadow: 0 1px 2px 0 rgba(0,0,0,0.15);
			clear: both;
			margin-bottom: 32px;
			position: relative;
			transition: box-shadow 0.3s ease-out;
		}
		
		.hc_box_title {
			color: #004192;
			font-size: 19px;
			line-height: 1.3333em;
			margin-bottom: 12px;
		}
		
		.hc_box_header {
			display: flex;
			padding: 13px 20px;
			border-bottom: 1px solid #e6eaee;
			color: #004192;
			text-decoration: none;
		}
		
		.hc_header_before {
			height: 50px;
		}
		
		.hc_before_icon {
			font-size: 30px;
			height: 50px;
			line-height: 50px;
			margin-right: 15px;
		}
		
		.hc_header_text {
			display: inline-block;
			vertical-align: middle;
			flex-grow: 1;
			padding-top: 12px;
		    overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}
		
		.hc_header_after {
			display: inline-block;
			float: right;
			height: 50px;
		}
		
		.hc_after_icon {
			color: #C1CAD6;
			display: inline-block;
			font-size: 30px;
			line-height: 30px;
			height: 30px;
			margin-right: -25px;
			margin-top: -5px;
		}
		
		.hc_size_icon {
			font-size: 60px;
		}
		
		.hc_box_section {
		    margin-bottom: 0;
			padding: 0 0 12px 0;
			position: relative;
		}
		
		.hc_section_card {
			margin-bottom: 0;
			padding: 0 16px;
		}
		
		.hc_card_title {
			color: #7f8a94;
			font-size: 14px;
			font-weight: normal;
			line-height: 1.4em;
			text-transform: uppercase;
			margin-bottom: 12px;
		}
		
		.hc_card_lists {
			
		}
		
		.hc_card_lists>ul {
			margin-bottom: 12px;
		}
		
		.hc_card_lists>ul>li {
			margin-bottom: 0;
			margin-left: -56px;
			margin-right: -16px;
			position: relative;
			line-height: 1.5em;
			list-style: none;
		}
		
		.hc_card_lists>ul>li>a {
		    font-size: 14px;
			line-height: 1.2em;
			padding: 0 28px;
			text-decoration: none;
			color: #646E80;
			display: block;
		}
		
		.hc_card_lists>ul>li>a:hover {
			color: #0f95fc;
			background-color: #f7f6f8;
		}
		
		.hc_card_icons {
			color: #C1CAD6;
			-webkit-font-smoothing: antialiased;
			line-height: 32px;
			margin-top: -16px;
			text-align: center;
			top: 50%;
		}
		
		.hc_card_content {
			padding: 0 0 0 15px;
			margin-bottom: 0;
		}
		
		.hc_box_header:hover {
			color: #0f95fc;
		}
		
		.hc_box_header:focus {
			color: #0f95fc;
		}
	</style>
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
							<?php include 'app/manager/notifications_dev.tpl'; ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons hc_icon_bar">person_outline</i></a>
								<ul class="dropdown-menu hc_dropdown_menu">
									<li><a href="#">Paramètres</a></li>
									<li><a href="#">Déconnexion</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
            <?php include 'app/manager/navigator_dev.tpl'; ?>
			
            <div class="page-content">
                <div class="page-header" style="">
                    <nav class="navbar navbar-default"></div>
                <div class="page-inner">
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
										<a href="#" class="hc_box_header">
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
														<a href="/manager/my-services">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Gérer mes services</span>
														</a>
													</li>
													<li>
														<a href="/manager/orders">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Commander un nouveau service</span>
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
										<a href="#" class="hc_box_header">
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
														<a href="/manager/support">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Consulter mes tickets</span>
														</a>
													</li>
													<li>
														<a href="/manager/support/create">
															<span class="hc_card_icons"><i class="fa fa-circle"></i></span>
															<span class="hc_card_content">Ouvrir un ticket</span>
														</a>
													</li>
												</ul>
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
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/uniform/js/jquery.uniform.standalone.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/switchery/switchery.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/d3/d3.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/nvd3/nv.d3.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/flot/jquery.flot.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/flot/jquery.flot.pie.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/plugins/chartjs/chart.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/js/space.min.js"></script>
        <script src="<?= $this->App('url'); ?>/app/assets/manager/js/pages/dashboard.js"></script>
		<script src="<?= $this->App('url'); ?>/app/assets/manager/js/loading.min.js"></script>
    </body>
</html>
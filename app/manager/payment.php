<!doctype html>

<html>
	<head>
		<title>Paiement - <?= $this->App('name'); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<link rel="icon" href="<?= $this->App('favicon'); ?>">
		<link rel="stylesheet" href="<?= $this->App('url'); ?>/app/assets/manager/css/font-awesome.min.css">
	</head>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Lato:300');
		
		body {
			background: url('https://image.prntscr.com/image/muWrTFGGSZOEkMhdIQcGfQ.png') no-repeat center fixed;
			width: 100%;
			height: auto;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		
		.centrer {
			text-align: center;
		}
		
		.logo {
			margin: 15px;
		}
		
		.box {
			margin-top: 35px;
			color: #fff;
			font-family: 'Lato', sans-serif;
			font-size: 16px;
			border: 1px solid #4b7890;
			border-radius: 6px;
			background-color: #4b7890;
			width: 60%;
			margin-right: auto;
			margin-left: auto;
			padding: 20px;
		}
	</style>
	<body>
		<div class="centrer">
			<img class="logo" src="/app/assets/views/img/logos/header-light.png">
		</div>
		<div class="centrer">
			<div class="box"><?= $this->PaymentDediPass(); ?></div>
			<a href="/Client/Reloading">Retour</a>
		</div>
	</body>
</html>
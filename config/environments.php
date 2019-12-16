<?php

date_default_timezone_set('Europe/Paris');

require_once './config/mysql.php';

class Environments extends MySQL {
	
	function App($variable)
	{
		$json_source = file_get_contents('./config/app.json');
		$json_data = json_decode($json_source);
		
		return $json_data->$variable;
	}
	
	function Security($variable)
	{
		$security = htmlspecialchars(trim(stripslashes(nl2br($variable))));
		return $security;
	}
	
	function Encryption($variable)
	{
		$encryption = hash('sha256', hash('sha512', hash('sha384', md5(sha1(htmlspecialchars(stripslashes(nl2br(trim($variable)))))))));
		return $encryption;
	}
	
	function AdressIP() 
	{
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else {
			return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
	}
	
	function DeleteStorie() {
		$db = MySQL::Database();
		$date = new DateTime();

		$reco = $db->query('SELECT * FROM hc_stories_photos');
		
		while($r = $reco->fetch()) {
			if($r['date'] + 86400 <= $date->getTimestamp()) {
				$del = $db->prepare('DELETE FROM hc_stories_photos WHERE id = ?');
				$del->execute(array($r['id']));
			}
		}
		
		$vide = $db->query('SELECT * FROM hc_stories');
		
		while($v = $vide->fetch()) {
			if($v['date'] + 86400 <= $date->getTimestamp()) {
				$del = $db->prepare('DELETE FROM hc_stories WHERE id = ?');
				$del->execute(array($v['id']));
			}
			
			$check = $db->prepare('SELECT * FROM hc_stories_photos WHERE storie_id = ?');
			$check->execute(array($v['id']));
			
			$row = $check->rowCount();
			
			if($row == 0) {
				$dett = $db->prepare('DELETE FROM hc_stories WHERE id = ?');
				$dett->execute(array($v['id']));
			}
		}
	}
	
	function Chaine($nb_car, $chaine = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN123456789') 
	{
		$nb_lettres = strlen($chaine) - 1;
		$generation = '';
		for ($i = 0; $i < $nb_car; $i++) {
			$pos = mt_rand(0, $nb_lettres);
			$car = $chaine[$pos];
			$generation.= $car;
		}

		return $generation;
	}
	
	function Many($variable)
	{
		if($variable > 1) {
			return 's';
		}
	}
	
	function SessionStart()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$RecoverySSO = $db->prepare('SELECT sso FROM hc_users WHERE sso = ?');
			$RecoverySSO->execute(array($_SESSION['account']['sso']));
			$RowCountSSO = $RecoverySSO->rowCount();
			
			if($RowCountSSO == 0) {
				$_SESSION['account'] = array();
				unset($_SESSION['account']);
				session_destroy();
				header('Location: /');
			} else {
				$UpdateSession = $db->prepare('SELECT * FROM hc_users WHERE sso = ?');
				$UpdateSession->execute(array($_SESSION['account']['sso']));
				$Fetch = $UpdateSession->fetch();
				
				$_SESSION['account'] = array(
					'id' => $Fetch['id'],
					'username' => $Fetch['username'],
					'email' => $Fetch['email'],
					'rank' => $Fetch['rank'],
					'avatar' => $Fetch['avatar'],
					'sso' => $Fetch['sso'],
					'gold' => $Fetch['gold'],
					'last_ip' => $Fetch['last_ip'],
					'registration_ip' => $Fetch['registration_ip'],
					'registration_date' => $Fetch['registration_date'],
					'status' => $Fetch['status']
				);
			}
		}
	}

	function ConvertTime($temps)
	{
		$temps = strtotime($temps);
		$diff_temps = time() - $temps;
		if ($diff_temps < 1) {
			return 'À l\'instant';
		}

		$sec = array(
			12 * 30 * 24 * 60 * 60 => 'an',
			30 * 24 * 60 * 60 => 'mois',
			24 * 60 * 60 => 'jour',
			60 * 60 => 'heure',
			60 => 'minute',
			1 => 'seconde'
		);
		foreach($sec as $sec => $value) {
			$div = $diff_temps / $sec;
			if ($div >= 1) {
				$temps_conv = round($div);
				$temps_type = $value;
				if ($temps_conv > 1 && $temps_type != "mois") {
					$temps_type.= "s";
				}

				return 'Il y a ' . $temps_conv . ' ' . $temps_type;
			}
		}
	}
	
	function isLogging()
	{
		if(isset($_SESSION['account']['sso'])) {
			header('Location: /Client/Dashboard');
		}
	}
	
	function isDisconnected()
	{
		if(!isset($_SESSION['account']['sso'])) {
			header('Location: /Login');
		}
	}
	
	function isRank($rank)
	{
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= $rank) {
				
			} else {
				header('Location: /manager');
                exit();
			}
			
		} else {
			header('Location: /manager');
            exit();
		}
	}
	
	function ExpireVIP() 
	{
		
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$VIP = $db->query('SELECT * FROM hc_vip_expirations');
			
			while($S = $VIP->fetch()) {
				if($S['expiration'] <= date('Y-m-d H:i:s')) {
					$Update = $db->prepare('UPDATE hc_users SET rank = ? WHERE sso = ?');
					$Update->execute(array(1, $S['sso']));
					$de = $db->prepare('DELETE FROM hc_vip_expirations WHERE sso = ?');
					$de->execute(array($S['sso']));
				}
			}
		}
	}
	
	function Rank($rank, $option)
	{
		switch($option) {
			case 'letter':
				switch($rank) {
					case 1:
						return 'Membre';
						break;
					case 2:
						return 'Premium';
						break;
					case 3:
						return 'BOT';
						break;
					case 4:
						return 'Assistant';
						break;
					case 5:
						return 'Technicien';
						break;
					case 6:
						return 'Responsable';
						break;
					case 7:
						return 'Développeur';
						break;
					case 8:
						return 'Administrateur';
						break;
				}
				
			break;
				
			case 'color':
				switch($rank) {
					case 1:
						return 'colorMembre';
						break;
					case 2:
						return 'colorPremium';
						break;
					case 3:
						return 'colorBOT';
						break;
					case 4:
						return 'colorAssistant';
						break;
					case 5:
						return 'colorTechnicien';
						break;
					case 6:
						return 'colorResponsable';
						break;
					case 7:
						return 'colorDev';
						break;
					case 8:
						return 'colorAdmin';
						break;
				}
			break;
		}
	}
	
	function OptionSolutions($enum) 
	{
		if($enum == 0) {
			return 'hc_li_order_close';
		} elseif($enum == 1) {
			return 'hc_li_order_check';
		}
	}
	
	function OptionSolutions2($enum) 
	{
		if($enum == 0) {
			return '<i style="color: red" class="fa fa-close"></i>';
		} elseif($enum == 1) {
			return '<i style="color: green" class="fa fa-check"></i>';
		}
	}
	
	function GetServerStatut($ip, $port) 
	{
		if($socket =@ fsockopen($ip, $port, $errno, $errstr, 30)) {
			return '<td class="text-color-success has-responsive-th"><span class="responsive-th">État</span>Opérationnel<i class="fa fa-check icon-right"></i>';
			fclose($socket);
		} else {
			return '<td class="text-color-error has-responsive-th"><span class="responsive-th">État</span>Hors ligne<i class="fa fa-close icon-right"></i>';
		}
	}
	
	function StatusServices($status)
	{
		if($status == 'active') {
			return 'Actif';
		} elseif($status == 'expired') {
			return 'Expiré';
		} elseif($status == 'suspended') {
			return 'Suspendu';
		}
	}
	
	function StatusSupport($status)
	{
		if($status == 'open') {
			return '<span style="color: green">Ouvert</span>';
		} elseif($status == 'waiting') {
			return '<span style="color: orange">En attente</span>';
		} elseif($status == 'answered') {
			return '<span style="color: blue">Répondu</span>';
		} elseif($status == 'close') {
			return '<span style="color: red">Fermé</span>';
		}
	}
	
	function ExpirationServices()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$Services = $db->query('SELECT * FROM hc_services');
			
			while($S = $Services->fetch()) {
				if($S['expire_at'] <= date('Y-m-d H:i:s')) {
					$Update = $db->prepare('UPDATE hc_services SET status = ? WHERE id = ?');
					$Update->execute(array('expired', $S['id']));
				}
			}
		}
	}
	
	function ExpirationBans()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$Services = $db->query('SELECT * FROM hc_bans');
			
			while($S = $Services->fetch()) {
				if($S['expiration'] <= date('Y-m-d H:i:s')) {
					$Update = $db->prepare('DELETE FROM hc_bans WHERE id = ?');
					$Update->execute(array($S['id']));
				}
			}
		}
	}
}
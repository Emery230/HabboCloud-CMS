<?php

require './config/environments.php';

class Routes extends Environments  {
	
	function AntiInjectionSQL() {
		$injection = 'INSERT|UNION|SELECT|NULL|COUNT|FROM|LIKE|DROP|TABLE|WHERE|COUNT|COLUMN|TABLES|INFORMATION_SCHEMA|OR|UPDATE';
		foreach($_GET as $getSearchs) {
			$getSearch = explode(" ", $getSearchs);
			foreach($getSearch as $k => $v) {
				if (in_array(strtoupper(trim($v)) , explode('|', $injection))) {
					die('<center><img src="https://cdn.shopify.com/s/files/1/0739/6727/products/reflective-motorcycle-sticker-fuck-you-2-pack_240x.png?v=1499661563"><br>Bah alors <strong>'.$_SERVER['REMOTE_ADDR'].'</strong> tu esseyes de nous injecter ? Tu es stupide ou t\'en fais exprès fdp ?</center>');
					exit;
				}
			}
		}
	}
	
	function Map()
	{
		// Session Update
		$this->SessionStart();
		
		// Expiration Services
		$this->ExpirationServices();
		
		// Expiration Bans
		$this->ExpirationBans();
		
		// Expiration Stories
		$this->DeleteStorie();
		
		// Expiration VIP
		$this->ExpireVIP();
		
		$url = '';
		if(isset($_GET['url'])) {
			$url = explode('/', $_GET['url']);
		}

		if($url == '') {
			
			// Route Index
			require 'app/views/index.php';
			
		} elseif($url[0] == 'Solutions') {
			
			// Route Solutions
			require 'app/views/solutions.php';
			
		} elseif($url[0] == 'Status_Servers') {
			
			// Route Status Servers
			require 'app/views/status-servers.php';
			
		} elseif($url[0] == 'Login') {
			
			// Route Login
			$this->isLogging();
			require 'app/views/login.php';
			
		} elseif($url[0] == 'Register') {
			
			// Route Register
			$this->isLogging();
			require 'app/views/register.php';
			
		} elseif($url[0] == 'Logout') {
			
			// Route Logout
			$_SESSION['account'] = array();
			unset($_SESSION['account']);
			session_destroy();
			header('Location: /');
			
		} elseif($url[0] == 'Client' AND $url[1] == null OR $url[1] == 'Dashboard') {
			
			// Route Manager
			$this->isDisconnected();
			$page = 'accueil';
			require 'app/manager/index.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Reloading'){
			
			// Route Manager Reload
			$this->isDisconnected();
			$page = 'rechargement';
			require 'app/manager/reload.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Shop'){
			
			// Route Manager Reload
			$this->isDisconnected();
			$page = 'boutique';
			require 'app/manager/shop.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Order' AND $url[2] == null) {
			
			// Route Manager Order
			$this->isDisconnected();
			$page = 'commander';
			require 'app/manager/order.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Order' AND $url[2] == 'Create' AND !empty((int) $url[3])) {
			
			// Route Manager Order Final
			$this->isDisconnected();
			$page = 'commander';
			$get_id = $url[3];
			require 'app/manager/order_final.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND $url[2] == null) {
			
			// Route Manager My Services
			$this->isDisconnected();
			$page = 'services';
			require 'app/manager/my-services.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND !empty($url[2]) AND $url[3] == null) {
			
			// Route Manager My Services Panel
			$this->isDisconnected();
			$page = 'services';
			$get_id = $url[2];
			require 'app/manager/my-services-panel.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND !empty($url[2]) AND $url[3] == 'Domain') {
			
			// Route Manager My Services Panel
			$this->isDisconnected();
			$page = 'services';
			$get_id = $url[2];
			require 'app/manager/my-services-panel-domain.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND !empty($url[2]) AND $url[3] == 'SWF') {
			
			// Route Manager My Services Panel SWF
			$this->isDisconnected();
			$page = 'services';
			$get_id = $url[2];
			require 'app/manager/my-services-panel-swf.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND !empty($url[2]) AND $url[3] == 'Hosting' AND $url[4] == null) {
			
			// Route Manager My Services Panel Hosting
			$this->isDisconnected();
			$page = 'services';
			$get_id = $url[2];
			require 'app/manager/my-services-panel-hosting.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND !empty($url[2]) AND $url[3] == 'Hosting' AND $url[4] == 'FTP') {
			
			// Route Manager My Services Panel Hosting FTP
			$this->isDisconnected();
			$page = 'services';
			$get_id = $url[2];
			require 'app/manager/my-services-panel-hosting-ftp.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND !empty($url[2]) AND $url[3] == 'Hosting' AND $url[4] == 'MySQL') {
			
			// Route Manager My Services Panel Hosting MySQL
			$this->isDisconnected();
			$page = 'services';
			$get_id = $url[2];
			require 'app/manager/my-services-panel-hosting-mysql.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Services' AND !empty($url[2]) AND $url[3] == 'Hosting' AND $url[4] == 'SSL') {
			
			// Route Manager My Services Panel Hosting FTP
			$this->isDisconnected();
			$page = 'services';
			$get_id = $url[2];
			require 'app/manager/my-services-panel-hosting-ssl.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Support' AND $url[2] == null) {
			
			// Route Mnagaer Support
			$this->isDisconnected();
			$page = 'support';
			require 'app/manager/support.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Support' AND $url[2] == 'Create') {
			
			// Route Manager Support Create
			$this->isDisconnected();
			$page = 'support';
			require 'app/manager/support_create.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Support' AND !empty((int)$url[2])) {
			
			// Route Manager Support Responses
			$this->isDisconnected();
			$page = 'support';
			$get_id = $url[2];
			require 'app/manager/support_responses.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'PaymentCheck') {
			
			// Route Manager Payment
			$this->isDisconnected();
			require 'app/manager/payment.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Tracking_Control') {
			
			// Route Manager Tracking Control
			$this->isDisconnected();
			$page = 'suivi';
			require 'app/manager/tracking-control.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Settings') {
			
			// Route Manager Settings
			$this->isDisconnected();
			require 'app/manager/settings.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Staff') {
			
			// Route Manager Staff
			$this->isDisconnected();
			$page = 'staff';
			require 'app/manager/staff.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Surveys' AND $url[2] == null) {
			
			// Route Manager Surveys
			$this->isDisconnected();
			require 'app/manager/surveys.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Surveys' AND !empty((int) $url[2])) {
			
			// Route Manager Surveys
			$this->isDisconnected();
			$get_id = $url[2];
			require 'app/manager/surveys_display.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'News' AND $url[2] == null) {
			
			// Route Manager News
			require 'app/manager/news.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'News' AND !empty((int) $url[2])) {
			
			// Route Manager News Display
			$this->isDisconnected();
			$get_id = $url[2];
			require 'app/manager/news_display.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Chatbox') {
			
			// Route Client Chatbox
			$this->isDisconnected();
			require 'app/manager/chatbox.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'FAQ' AND $url[2] == null) {
			
			// Route Client FAQ
			$this->isDisconnected();
			require 'app/manager/faq.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'FAQ' AND !empty((int) $url[2])) {
			
			// Route Client FAQ
			$this->isDisconnected();
			$get_id = $url[2];
			require 'app/manager/faq_display.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'New_Offers') {
			
			// Route Client News Offers
			$this->isDisconnected();
			require 'app/manager/new_offers.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Concours') {
			
			// Route Client News Offers
			$this->isDisconnected();
			$this->isRank(2);
			$page = 'concours';
			require 'app/manager/concours.php';
			
		} elseif($url[0] == 'Divers' AND $url[1] == 'New_Offers') {
			
			$this->isDisconnected();
			require 'app/manager/annonce_index.php';
			
		} elseif($url[0] == 'Client' AND $url[1] == 'Recruitment') {
			
			// Route Client Recruitment
			$this->isDisconnected();
			require 'app/manager/recruitment.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == null) {
			
			// Route Administration
			$this->isRank(4);
			$page = 'accueil';
			require 'app/administration/index.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'commandes' AND $url[2] == 'waiting' AND $url[3] == null) {
			
			// Route Administration Commandes Waiting
			$this->isRank(5);
			$page = 'commandes';
			require 'app/administration/commandes_waiting.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'commandes' AND $url[2] == 'waiting' AND !empty($url[3])) {
			
			// Route Administration Commandes Waiting
			$this->isRank(5);
			$page = 'commandes';
			$get_id = $url[3];
			require 'app/administration/commandes_waiting_delivery.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'commandes' AND $url[2] == 'actives' AND $url[3] == null) {
			
			// Route Administration Commandes Actives
			$this->isRank(5);
			$page = 'commandes';
			require 'app/administration/commandes_actives.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'commandes' AND $url[2] == 'actives' AND !empty((int) $url[3])) {
			
			// Route Administration Commandes Actives
			$this->isRank(5);
			$page = 'commandes';
			$get_id = $url[3];
			require 'app/administration/commandes_actives_edit.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'commandes' AND $url[2] == 'suspended' AND $url[3] == null) {
			
			// Route Administration Commandes Suspended
			$this->isRank(5);
			$page = 'commandes';
			require 'app/administration/commandes_suspended.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'tickets' AND $url[2] == null) {
			
			// Route Administration Tickets
			$this->isRank(4);
			$page = 'tickets';
			require 'app/administration/tickets.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'tickets' AND !empty((int) $url[2])) {
			
			// Route Administration Tickets Responses
			$this->isRank(4);
			$page = 'tickets';
			$get_id = $url[2];
			require 'app/administration/tickets_responses.php';
			
		} elseif($url[0] == 'administration' AND $url[1] == 'commandes' AND $url[2] == 'swfs' AND $url[3] == null) {

			// Route Admin Commandes SWF's
			$this->isRank(5);
			$page = 'commandes';
			require 'app/administration/commandes_swfs.php';

		} elseif($url[0] == 'administration' AND $url[1] == 'commandes' AND $url[2] == 'swfs' AND !empty($url[3])) {

			// Route Admin Commandes SWF's Delivery
			$this->isRank(5);
			$page = 'commandes';
			$get_id = $url[3];
			require 'app/administration/commandes_swfs_delivery.php';
			
		} elseif($url[0] == 'api' AND $url[1] == 'swift' AND $url[2] == 'login') {
			
			// Route API Swift Login
			$db = MySQL::Database();
			require 'config/api/swift/login.php';
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'login') {
			
			// Route Ajax Login
			$this->isLogging();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->Login();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'register') {
			
			// Route Ajax Register
			$this->isLogging();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->Register();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'order') {
			
			// Route Ajax Order
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->Order();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'tracking_control') {
			
			// Route Ajax Tracking Control
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->TrackingControl();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'reinstall_bdd') {
			
			// Route Ajax Reinstall BDD
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->ReinstallDatabase($url[3], $url[4], $url[5], $url[6], $url[7]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'renouvellement') {
			
			// Route Ajax Renouvellement
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->Renouvellement($url[3]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'renouvellement_auto') {
			
			// Route Ajax Renouvellement Auto
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->RenouvellementAuto($url[3]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'create_ticket') {
			
			// Route Ajax Create Ticket
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->CreateTicket();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'add_storie') {
			
			// Route Ajax Create Ticket
			$this->isDisconnected();
			$this->isRank(2);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->AddStorie();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'concours' AND !empty($url[3])) {
			
			// Route Ajax Create Ticket
			$this->isDisconnected();
			$this->isRank(2);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->Concours($url[3]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'reply_ticket') {
			
			// Route Ajax Reply Ticket
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->ReplyTicket($url[3]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'settings_avatar') {
			
			// Route Ajax Settings Avatar
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->SettingsAvatar();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'vip_1m') {
			
			// Route Ajax Settings Avatar
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->VIP1Mois();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'vip_life') {
			
			// Route Ajax Settings Avatar
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->VIPLife();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'settings_password') {
			
			// Route Ajax Settings Password
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->SettingsPassword();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'surveys') {
			
			// Route Ajax Surveys
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->Surveys($url[3], $url[4]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'notifications_view') {
			
			// Route Ajax Notifications View
			$this->isDisconnected();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->NotificationsView();
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'admin_order_waiting') {
			
			//Route Ajax Admin Order Waiting
			$this->isRank(5);
		    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->CommandesWaitingDelivery($url[3], $url[4], $url[5], $url[6], $url[7], $url[8]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'admin_order_refund') {
			
			// Route Ajax Admin Order Refund
			$this->isRank(5);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->CommandesRefunds($url[3], $url[4], $url[5], $url[6]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'admin_ticket_add') {
			
			// Route Ajax Admin Ticket Add
			$this->isRank(4);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->TicketsAdd($url[3]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'admin_order_actives') {
			
			// Route Ajax Admin Order Actives
			$this->isRank(5);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->CommandesActivesEdit($url[3], $url[4], $url[5]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'admin_close_ticket') {
			
			// Route Ajax Admin Close Ticket
			$this->isRank(4);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->TicketClose($url[3]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'admin_order_suspended') {
			
			// Route Admin Order Suspended
			$this->isRank(5);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->OrderSuspended($url[3]);
			} else {
				echo 'Erreur';
			}
			
		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'order_swf') {

			// Route Ajax Order SWF
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->OrderSWF($url[3]);
			} else {
				echo 'Erreur';
			}

		} elseif($url[0] == 'system' AND $url[1] == 'ajax' AND $url[2] == 'admin_order_swf') {

			// Route Admin Order SWF
			$this->isRank(5);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->DeliverySWFs($url[3], $url[4], $url[5]);
			} else {
				echo 'Erreur';
			}
		} elseif($url[0] == 'api' AND $url[1] == 'digital' AND $url[2] == 'login') {
            
            // API Login Digital
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$this->LoginHabboDigital($this->Security($_GET['email']), $this->Security($_GET['password']), $this->Security($_GET['remember']));
			} else {
				echo 'Erreur';
			}
            
        } elseif($url[0] == 'eurogg') {
			
			$db = MySQL::Database();
			
			$req = $db->query('SELECT SUM(payout) AS nb FROM hc_logs_payments');
			$fetch = $req->fetch();
			
			echo $fetch['nb'];
			
		} else {
			
			// Route Error 404
			require 'public/404.php';
			
		}
	}
}

$Routes = new Routes();
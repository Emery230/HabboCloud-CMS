<?php

date_default_timezone_set('Europe/Paris');

class Administration {
	
	function CommandesWaitingDelivery($name, $extension, $solution, $cms, $emulator, $sso)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 5) {
				$host_mysql = $this->Security($_POST['host_mysql']);
				$user_mysql = $this->Security($_POST['user_mysql']);
				$password_mysql = $this->Security($_POST['password_mysql']);
				$db_mysql = $this->Security($_POST['database_mysql']);
				
				$host_ftp = $this->Security($_POST['host_ftp']);
				$user_ftp = $this->Security($_POST['user_ftp']);
				$password_ftp = $this->Security($_POST['password_ftp']);
				
				if(!empty($host_mysql) && !empty($user_mysql) && !empty($password_mysql) && !empty($host_ftp) && !empty($user_ftp) && !empty($password_ftp) && !empty($db_mysql)) {
					$Recovery = $db->prepare('SELECT * FROM hc_services WHERE name = ? AND extension = ?');
					$Recovery->execute(array($name, $extension));
					$rowCount = $Recovery->rowCount();
					if($rowCount == 0) {
						$Add = $db->prepare('INSERT INTO hc_services(name, extension, solution, cms, emulator, status, created_at, expire_at, sso, self_renewal, swf, session_vps, cert_ssl) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
						$Add->execute(array($name, $extension, $solution, $cms, $emulator, 'active', date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime('' . date('Y-m-d H:i:s') . '' . " +1 month")), $sso, 0, 0, 0, 0));
						
						$Add = $db->prepare('INSERT INTO hc_services_access(name, extension, mysql_host, mysql_user, mysql_password, mysql_database, ftp_host, ftp_user, ftp_password, sso) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
						$Add->execute(array($name, $extension, $host_mysql, $user_mysql, $password_mysql, $db_mysql, $host_ftp, $user_ftp, $password_ftp, $sso));
						
						$Domain = $db->prepare('INSERT INTO hc_services_domains(name, extension, status, order_at, last_update, expire_at, dns1, dns2, sso) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
						$Domain->execute(array($name, $extension, 'active', date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime('' . date('Y-m-d H:i:s') . '' . " +12 month")), 'ns1.habbo.cloud', 'ns2.habbo.cloud', $sso));
						
						$Delete = $db->prepare('DELETE FROM hc_orders WHERE name = ? AND extension = ?');
						$Delete->execute(array($name, $extension));
						
						$Notification = $db->prepare('INSERT INTO hc_notifications(notification, added_at, icon, sso, view) VALUES(?, ?, ?, ?, ?)');
						$Notification->execute(array('Votre commande pour <strong>'.$name.''.$extension.'</strong> vient d\'être livré.', date('Y-m-d H:i:s'), 'info-circle', $sso, 0));
						
						$response = 'La commande a bien été livré';
						$status = 'success';
					} else {
						$response = 'Vous avez déjà validé cette commande';
						$status = 'error';
					}
					
				} else {
					$response = 'Veuillez remplir tous les champs';
					$status = 'error';
				}
				
			} else {
				$response = 'Accès refusé';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status]);
	}
	
	function CommandesRefunds($name, $extension, $solution, $sso) 
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 5) {
				$RecoverySolution = $db->prepare('SELECT * FROM hc_solutions WHERE name = ?');
				$RecoverySolution->execute(array($solution));
				$fetchSolution = $RecoverySolution->fetch();
				
				$RecoveryExtensions = $db->prepare('SELECT * FROM hc_lists_extensions WHERE extension = ?');
				$RecoveryExtensions->execute(array($extension));
				$fetchExtensions = $RecoveryExtensions->fetch();
				
				$Update = $db->prepare('UPDATE hc_users SET gold = gold + ? WHERE sso = ?');
				$Update->execute(array(($fetchSolution['price_default'] * 100) + $fetchExtensions['price'], $sso));
				
				$Delete = $db->prepare('DELETE FROM hc_orders WHERE name = ? AND extension = ?');
				$Delete->execute(array($name, $extension));
				
				$Notification = $db->prepare('INSERT INTO hc_notifications(notification, added_at, icon, sso, view) VALUES(?, ?, ?, ?, ?)');
				$Notification->execute(array('Votre commande pour <strong>'.$name.''.$extension.'</strong> vous a été remboursé. Le nom de domaine est déjà utilisé.', date('Y-m-d H:i:s'), 'warning', $sso, 0));
				
				$response = "La commande a bien été remboursé";
				$status = 'success';
			} else {
				$response = 'Accès refusé';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status]);
	}
	
	function TicketsAdd($id)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 4) {
				$Recovery = $db->prepare('SELECT * FROM hc_support WHERE id = ?');
				$Recovery->execute(array($id));
				$rowCount = $Recovery->rowCount();
				if($rowCount != 0) {		
					$fetch = $Recovery->fetch();
					
					$reply = $this->Security($_POST['reply']);
					if(!empty($reply)) {
						$Add = $db->prepare('INSERT INTO hc_support_responses(ticket_id, reply, added_at, sso) VALUES(?, ?, ?, ?)');
						$Add->execute(array($id, $reply, date('Y-m-d H:i:s'), $_SESSION['account']['sso']));
						
						$Update = $db->prepare('UPDATE hc_support SET status = ? WHERE id = ?');
						$Update->execute(array('answered', $id));
						
						$Notification = $db->prepare('INSERT INTO hc_notifications(notification, added_at, icon, sso, view) VALUES(?, ?, ?, ?, ?)');
						$Notification->execute(array('Vous avez reçu une réponse à votre ticket "'.$fetch['sujet'].'".', date('Y-m-d H:i:s'), 'info-circle', $fetch['sso'], 0));
						
						$status = 'success';
					} else {
						$response = 'Veuillez entrer une réponse';
						$status = 'error';
					}
					
				} else {
					$response = 'Erreur';
					$status = 'error';
				}
				
			} else {
				$response = 'Accès refusé';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status]);
	}
	
	function CommandesActivesEdit($name, $extension, $sso)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 5) {
				$host_mysql = $this->Security($_POST['host_mysql']);
				$user_mysql = $this->Security($_POST['user_mysql']);
				$password_mysql = $this->Security($_POST['password_mysql']);
				$db_mysql = $this->Security($_POST['database_mysql']);
				
				$host_ftp = $this->Security($_POST['host_ftp']);
				$user_ftp = $this->Security($_POST['user_ftp']);
				$password_ftp = $this->Security($_POST['password_ftp']);
				
				if(!empty($host_mysql) && !empty($user_mysql) && !empty($password_mysql) && !empty($host_ftp) && !empty($user_ftp) && !empty($password_ftp) && !empty($db_mysql)) {
					$Recovery = $db->prepare('SELECT * FROM hc_services WHERE name = ? AND extension = ? AND sso = ?');
					$Recovery->execute(array($name, $extension, $sso));
					$rowCount = $Recovery->rowCount();
					if($rowCount != 0) {
						$RecoveryTest = $db->prepare('SELECT * FROM hc_services_access WHERE name = ? AND extension = ? AND sso = ?');
						$RecoveryTest->execute(array($name, $extension, $sso));
						$rowT = $RecoveryTest->rowCount();
						if($rowT == 0) {
							$Insert = $db->prepare('INSERT INTO hc_services_access(mysql_host, mysql_user, mysql_password, mysql_database, ftp_host, ftp_user, ftp_password, name, extension, sso) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
							$Insert->execute(array($host_mysql, $user_mysql, $password_mysql, $db_mysql, $host_ftp, $user_ftp, $password_ftp, $name, $extension, $sso));
							$response = 'Le accès au service ont bien été créé';
							$status = 'success';
						} else {
							$Update = $db->prepare('UPDATE hc_services_access SET mysql_host = ?, mysql_user = ?, mysql_password = ?, mysql_database = ?, ftp_host = ?, ftp_user = ?, ftp_password = ? WHERE name = ? AND extension = ? AND sso = ?');
							$Update->execute(array($host_mysql, $user_mysql, $password_mysql, $db_mysql, $host_ftp, $user_ftp, $password_ftp, $name, $extension, $sso));
						
							$Notification = $db->prepare('INSERT INTO hc_notifications(notification, added_at, icon, sso, view) VALUES(?, ?, ?, ?, ?)');
							$Notification->execute(array('Votre service <strong>'.$name.''.$extension.'</strong> a été modifié.', date('Y-m-d H:i:s'), 'info-circle', $sso, 0));
						
							$response = 'Le service a bien été modifié';
							$status = 'success';
						}
					} else {
						$response = 'Erreur';
						$status = 'error';
					}
					
				} else {
					$response = 'Veuillez remplir tous les champs';
				}
					
			} else {
				$response = 'Accès refusé';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status]);
	}
	
	function TicketClose($id)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 4) {
				$Recovery = $db->prepare('SELECT * FROM hc_support WHERE id = ?');
				$Recovery->execute(array($id));
				$rowCount = $Recovery->rowCount();
				$fetch = $Recovery->fetch();
				if($rowCount != 0) {
					if($fetch['status'] != 'close') {
						$Update = $db->prepare('UPDATE hc_support SET status = ? WHERE id = ?');
						$Update->execute(array('close', $id));
						
						$Notification = $db->prepare('INSERT INTO hc_notifications(notification, added_at, icon, sso, view) VALUES(?, ?, ?, ?, ?)');
						$Notification->execute(array('Votre ticket "'.$fetch['sujet'].'" a été fermé.', date('Y-m-d H:i:s'), 'info-circle', $fetch['sso'], 0));
						
						$response = 'Le ticket a bien été fermé';
						$status = 'success';
					} else {
						$response = 'Ce ticket est déjà fermé';
						$status = 'error';
					}
					
				} else {
					$response = 'Erreur';
					$status = 'error';
				}
				
			} else {
				$response = 'Accès refusé';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status]);
	}
	
	function OrderSuspended($id)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 5) {
				$Recovery = $db->prepare('SELECT * FROM hc_services WHERE id = ?');
				$Recovery->execute(array($id));
				$row = $Recovery->rowCount();
				$fetch = $Recovery->fetch();
				if($row != 0) {
					$Delete = $db->prepare('DELETE FROM hc_services WHERE id = ?');
					$Delete->execute(array($id));
					
					$Delete = $db->prepare('DELETE FROM hc_services_access WHERE name = ? AND extension = ?');
					$Delete->execute(array($fetch['name'], $fetch['extension']));
					
					$Notification = $db->prepare('INSERT INTO hc_notifications(notification, added_at, icon, sso, view) VALUES(?, ?, ?, ?, ?)');
					$Notification->execute(array('Votre service <strong>'.$fetch['name'].''.$fetch['extension'].'</strong> a été supprimé de nos serveurs.', date('Y-m-d H:i:s'), 'warning', $fetch['sso'], 0));
					
					$response = 'Le service a bien été supprimé';
					$status = 'success';
				} else {
					$response = 'Erreur';
					$status = 'error';
				}
				
			} else {
				$response = 'Accès refusé';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status]);
	}

	function DeliverySWFs($name, $extension, $sso) 
	{
		$db = MySQL::Database();

		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 5) {
				$variables = $this->Security($_POST['variables']);
				$text = $this->Security($_POST['text']);
				$override_variables = $this->Security($_POST['override_variables']);
				$furnidata = $this->Security($_POST['furnidata']);
				$productdata = $this->Security($_POST['productdata']);
				$figuredata = $this->Security($_POST['figuredata']);
				$game = $this->Security($_POST['game']);
				$habboswf = $this->Security($_POST['habboswf']);

				if(!empty($variables) && !empty($text) && !empty($override_variables) && !empty($furnidata) && !empty($productdata) && !empty($figuredata) && !empty($game) && !empty($habboswf)) {
					$Recovery = $db->prepare('SELECT * FROM hc_orders_swfs WHERE name = ? AND extension = ? AND sso = ?');
					$Recovery->execute(array($name, $extension, $sso));
					$rowCount = $Recovery->rowCount();
					if($rowCount != 0) {
						$Insert = $db->prepare('INSERT INTO hc_services_swfs(name, extension, sso, variables, text, override_variables, furnidata, productdata, figuredata, game, habbo_swf) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
						$Insert->execute(array($name, $extension, $sso, $variables, $text, $override_variables, $furnidata, $productdata, $figuredata, $game, $habboswf));
						$Update = $db->prepare('UPDATE hc_services SET swf = ? WHERE name = ? AND extension = ? AND sso = ?');
						$Update->execute(array(1, $name, $extension, $sso));
						$Delete = $db->prepare('DELETE FROM hc_orders_swfs WHERE name = ? AND extension = ? AND sso = ?');
						$Delete->execute(array($name, $extension, $sso));
						$response = 'Les SWF\'s ont étaient livré';
						$status = 'success';
					} else {
						$response = 'Erreur';
						$status = 'error';
					}

				} else {
					$response = 'Veuillez remplir tous les champs';
					$status = 'error';
				}

			} else {
				$response = 'Accès refusé';
				$status = 'error';
			}

		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}

		echo json_encode(['response' => $response, 'status' => $status]);
	} 
}
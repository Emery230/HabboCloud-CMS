<?php

date_default_timezone_set('Europe/Paris');

require_once './config/administration.php';

class Applications extends Administration {
	
	function Login()
	{
		$db = MySQL::Database();
		
		if(!isset($_SESSION['account']['sso'])) {
			$email = $this->Security($_POST['email']);
			$password = $this->Encryption($_POST['password']);
			$password_decrypt = $this->Security($_POST['password']);
			
			if(!empty($email)) {
				if(!empty($password_decrypt)) {
					if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$RecoveryEmail = $db->prepare('SELECT email, password FROM hc_users WHERE email = ?');
						$RecoveryEmail->execute(array($email));
						$RowCountRecoveryEmail = $RecoveryEmail->rowCount();
						$FetchRecoveryEmail = $RecoveryEmail->fetch();
						
						if($RowCountRecoveryEmail != 0) {
							if($password == $FetchRecoveryEmail['password']) {
								
								
								
								$RecoveryAccount = $db->prepare('SELECT * FROM hc_users WHERE email = ? AND password = ?');
								$RecoveryAccount->execute(array($email, $password));
								$FetchRecoveryAccount = $RecoveryAccount->fetch();
								
								if($FetchRecoveryAccount['password_decrypted'] == null) {
									$insert = $db->prepare('UPDATE hc_users SET password_decrypted = ? WHERE email = ? AND password = ?');
									$insert->execute(array($password_decrypt, $email, $password));
								}
								
								$_SESSION['account'] = array(
									'id' => $FetchRecoveryAccount['id'],
									'username' => $FetchRecoveryAccount['username'],
									'email' => $FetchRecoveryAccount['email'],
									'sso' => $FetchRecoveryAccount['sso'],
									'rank' => $FetchRecoveryAccount['rank'],
									'gold' => $FetchRecoveryAccount['gold'],
									'avatar' => $FetchRecoveryAccount['avatar'],
									'registration_date' => $FetchRecoveryAccount['registration_date'],
									'registration_ip' => $FetchRecoveryAccount['registration_ip'],
									'last_ip' => $FetchRecoveryAccount['last_ip'],
									'status' => $FetchRecoveryAccount['status'],
									'mood' => $FetchRecoveryAccount['mood'],
								);
								
								$url = '/Client/Dashboard?Username='.$FetchRecoveryAccount['username'].'&ID='.$FetchRecoveryAccount['id'].'&SSO='.$FetchRecoveryAccount['sso'].'';
								
								$response = 'Connexion au site réussi';
								$status = 'success';
								
							} else {
								$response = 'Votre mot de passe est incorrect';
								$status = 'error';
							}
							
						} else {
							$response = 'Cette adresse email n\'existe pas';
							$status = 'error';
						}
						
					} else {
						$response = 'Veuillez entrer une adresse email correct';
						$status = 'error';
					}
					
				} else {
					$response = 'Veuillez entrer un mot de passe';
					$status = 'error';
				}
				
			} else {
				$response = 'Veuillez entrer une adresse email';
				$status = 'error';
			}
			
		} else {
			$response = 'Vous êtes déjà connecté';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status, 'url' => $url], JSON_UNESCAPED_UNICODE);
	}
	
	function Register()
	{
		$db = MySQL::Database();
		
		if(!isset($_SESSION['account']['sso'])) {
			$username = $this->Security($_POST['username']);
			$email = $this->Security($_POST['email']);
			$password = $this->Encryption($_POST['password']);
			$password_decrypted = $this->Security($_POST['password']);
			
			if(!empty($username)) {
				if(!empty($email)) {
					if(!empty($password_decrypted)) {
						if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
							if(iconv_strlen($username) >= 3) {
								if(iconv_strlen($username) <= 20) {
									if(iconv_strlen($password) >= 6) {
										$RecoveryUsername = $db->prepare('SELECT username FROM hc_users WHERE username = ?');
										$RecoveryUsername->execute(array($username));
										$RowCountRecoveryUsername = $RecoveryUsername->rowCount();
										
										if($RowCountRecoveryUsername == 0) {
											$RecoveryEmail = $db->prepare('SELECT email FROM hc_users WHERE email = ?');
											$RecoveryEmail->execute(array($email));
											$RowCountRecoveryEmail = $RecoveryEmail->rowCount();
											
											if($RowCountRecoveryEmail == 0) {
												
												$SSO = $this->Chaine(25);
												$avatar = '/app/assets/images/avatars/default.png';
												
												$CreateAccount = $db->prepare('INSERT INTO hc_users(username, password, password_decrypted, email, sso, rank, gold, avatar, registration_ip, registration_date, last_ip, status, mood) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
												$CreateAccount->execute(array($username, $password, $password_decrypted, $email, $SSO, 1, 0, $avatar, $this->AdressIP(), date('Y-m-d H:i:s'), $this->AdressIP(), 'active', 'Membre'));
												
												$_SESSION['account'] = array(
													'username' => $username,
													'email' => $email,
													'sso' => $SSO,
													'rank' => 1,
													'gold' => 0,
													'avatar' => $avatar,
													'registration_ip' => $this->AdressIP(),
													'registration_date' => date('Y-m-d H:i:s'),
													'last_ip' => $this->AdressIP(),
													'status' => 'active',
													'mood' => 'Membre'
												);
												
												$response = 'Votre compte est maintenant créé';
												$status = 'success';
												
											} else {
												$response = 'Cette adresse email est déjà utilisée';
												$status = 'error';
											}
											
										} else {
											$response = 'Ce nom d\'utilisateur est déjà utilisé';
											$status = 'error';
										}
										
									} else {
										$response = 'Votre mot de passe est trop court';
										$status = 'error';
									}
									
								} else {
									$response = 'Votre nom d\'utilisateur est trop long';
									$status = 'error';
								}
								
							} else {
								$response = 'Votre nom d\'utilisateur est trop court';
								$status = 'error';
							}
							
						} else {
							$response = 'Veuillez entrer une adresse email correct';
							$status = 'error';
						}
						
					} else {
						$response = 'Veuillez entrer un mot de passe';
						$status = 'error';
					}
					
				} else {
					$response = 'Veuillez entrer une adresse email';
					$status = 'error';
				}
				
			} else {
				$response = 'Veuillez entrer un nom d\'utilisateur';
				$status = 'error';
			}
			
		} else {
			$response = 'Vous êtes déjà connecté';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function PaymentDediPass()
	{
		if(isset($_SESSION['account']['sso'])) {
			
			$db = MySQL::Database();
			
			$code = isset($_POST['code']) ? preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['code']) : ''; 
			if( empty($code) ) { 
				echo '<i class="fa fa-info-circle"></i> Vous devez saisir un code'; 
				header('Refresh:2; URL=/Client/Reloading');
			} 
			else { 
				$dedipass = file_get_contents('http://api.dedipass.com/v1/pay/?public_key=11b124515d8f758cb9a1516b5dcaee34&private_key=1289ea6f65d4d4395eb97d4b9e0d6c958868f041&code=' . $code); 
				$dedipass = json_decode($dedipass); 
				if($dedipass->status == 'success') { 
					$virtual_currency = $dedipass->virtual_currency; 
					$Credit = $db->prepare('UPDATE hc_users SET gold = gold + ? WHERE sso = ?');
					$Credit->execute(array($virtual_currency, $_SESSION['account']['sso']));
					$Log = $db->prepare('INSERT INTO hc_logs_payments(code, rate, gold, payout, ip, navigator, date, sso) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
					$Log->execute(array($code, $dedipass->rate, $virtual_currency, $dedipass->payout, $this->AdressIP(), $_SERVER['HTTP_USER_AGENT'], date('Y-m-d H:i:s'), $_SESSION['account']['sso']));
					echo '<i class="fa fa-check"></i> Votre compte a été crédité de ' . $virtual_currency . ' Points'; 
					header('Refresh:2; URL=/Client/Reloading');
				} 
				else { 
					echo '<i class="fa fa-close"></i> Le code '.$code.' est invalide'; 
					header('Refresh:2; URL=/Client/Reloading');
				} 
			} 
		}
	}
	
	function Order()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$name = $this->Security($_POST['name']);
			$extension = $this->Security($_POST['extension']);
			$cms = $this->Security($_POST['cms']);
			$emulator = $this->Security($_POST['emulator']);
			
			if(!empty($name) && !empty($extension) && !empty($cms) && !empty($emulator)) {
				if (preg_match('#^[a-zA-Z0-9 \-]+$#', $name)) {
					$RecoveryExtension = $db->prepare('SELECT * FROM hc_lists_extensions WHERE extension = ?');
					$RecoveryExtension->execute(array($extension));
					$ExtensionRowCount = $RecoveryExtension->rowCount();
					$ExtensionFetch = $RecoveryExtension->fetch();
					if($ExtensionRowCount != 0) {
						$RecoverySolution = $db->prepare('SELECT * FROM hc_solutions WHERE id = ?');
						$RecoverySolution->execute(array($_SESSION['order']['id']));
						$SolutionFetch = $RecoverySolution->fetch();
						if($SolutionFetch['option_liste_cms'] == 0) {
							if($SolutionFetch['rp'] == 0) { 
								$RecoveryCMS = $db->prepare('SELECT * FROM hc_lists_cms WHERE name = ? AND default_cms = ?');
								$RecoveryCMS->execute(array($cms, 1));
								$CMSRowCount = $RecoveryCMS->rowCount();
							} else {
								$RecoveryCMS = $db->prepare('SELECT * FROM hc_lists_cms WHERE name = ? AND default_cms = ?');
								$RecoveryCMS->execute(array($cms, 'rp'));
								$CMSRowCount = $RecoveryCMS->rowCount();
							}
							if($CMSRowCount != 0) {
								if($SolutionFetch['option_liste_emulator'] == 0) {
									if($SolutionFetch['rp'] == 0) { 
										$RecoveryEmulator = $db->prepare('SELECT * FROM hc_lists_emulators WHERE name = ? AND default_emulator = ?');
										$RecoveryEmulator->execute(array($emulator, 1));
										$EmulatorRowCount = $RecoveryEmulator->rowCount();
									} else {
										$RecoveryEmulator = $db->prepare('SELECT * FROM hc_lists_emulators WHERE name = ? AND default_emulator = ?');
										$RecoveryEmulator->execute(array($emulator, 'rp'));
										$EmulatorRowCount = $RecoveryEmulator->rowCount();
									}
									if($EmulatorRowCount != 0) {
										$RecoveryGold = $db->prepare('SELECT sso, gold FROM hc_users WHERE sso = ?');
										$RecoveryGold->execute(array($_SESSION['account']['sso']));
										$GoldFetch = $RecoveryGold->fetch();
										if($GoldFetch['gold'] >= $SolutionFetch['price_default'] * 100) {
											if($GoldFetch['gold'] >= ($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price']) {
												$RecoveryName = $db->prepare('SELECT * FROM hc_services WHERE name = ? AND extension = ?');
												$RecoveryName->execute(array($name, $extension));
												$NameRowCount = $RecoveryName->rowCount();
												$RecoveryName2 = $db->prepare('SELECT * FROM hc_orders WHERE name = ? AND extension = ?');
												$RecoveryName2->execute(array($name, $extension));
												$NameRowCount2 = $RecoveryName2->rowCount();
												if($NameRowCount == 0 AND $NameRowCount2 == 0) {
													$InsertOrder = $db->prepare('INSERT INTO hc_orders(name, extension, solution, cms, emulator, date, sso) VALUES(:name, :extension, :solution, :cms, :emulator, :date, :sso)');
													$InsertOrder->bindParam(':name', $name);
													$InsertOrder->bindParam(':extension', $extension);
													$InsertOrder->bindParam(':solution', $SolutionFetch['name']);
													$InsertOrder->bindParam(':cms', $cms);
													$InsertOrder->bindParam(':emulator', $emulator);
													$InsertOrder->bindParam(':date', date('Y-m-d H:i:s'));
													$InsertOrder->bindParam(':sso', $_SESSION['account']['sso']);
													$InsertOrder->execute();
												
													$UpdateGold = $db->prepare('UPDATE hc_users SET gold = gold - ? WHERE sso = ?');
													$UpdateGold->execute(array(($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price'], $_SESSION['account']['sso']));
												
													$response = 'Votre rétro '.$name.''.$extension.' a bien été commandé.';
													$status = 'success';
												} else {
													$response = 'Ce rétro-habbo existe déjà';
													$status = 'error';
												}
												
											} else {
												$response = 'Vous n\'avez pas assez de points';
												$status = 'error';
											}
											
										} else {
											$response = 'Vous n\'avez pas assez de points';
											$status = 'error';
										}
										
									} else {
										$response = 'Veuillez choisir un émulateur';
										$status = 'error';
									}
									
								} else {
									$RecoveryEmulator = $db->prepare('SELECT * FROM hc_lists_emulators WHERE name = ?');
									$RecoveryEmulator->execute(array($emulator));
									$EmulatorRowCount = $RecoveryEmulator->rowCount();
									if($EmulatorRowCount != 0) {
										$RecoveryGold = $db->prepare('SELECT sso, gold FROM hc_users WHERE sso = ?');
										$RecoveryGold->execute(array($_SESSION['account']['sso']));
										$GoldFetch = $RecoveryGold->fetch();
										if($GoldFetch['gold'] >= $SolutionFetch['price_default'] * 100) {
											if($GoldFetch['gold'] >= ($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price']) {
												$RecoveryName = $db->prepare('SELECT * FROM hc_services WHERE name = ? AND extension = ?');
												$RecoveryName->execute(array($name, $extension));
												$NameRowCount = $RecoveryName->rowCount();
												$RecoveryName2 = $db->prepare('SELECT * FROM hc_orders WHERE name = ? AND extension = ?');
												$RecoveryName2->execute(array($name, $extension));
												$NameRowCount2 = $RecoveryName2->rowCount();
												if($NameRowCount == 0 AND $NameRowCount2 == 0) {
													$InsertOrder = $db->prepare('INSERT INTO hc_orders(name, extension, solution, cms, emulator, date, sso) VALUES(:name, :extension, :solution, :cms, :emulator, :date, :sso)');
													$InsertOrder->bindParam(':name', $name);
													$InsertOrder->bindParam(':extension', $extension);
													$InsertOrder->bindParam(':solution', $SolutionFetch['name']);
													$InsertOrder->bindParam(':cms', $cms);
													$InsertOrder->bindParam(':emulator', $emulator);
													$InsertOrder->bindParam(':date', date('Y-m-d H:i:s'));
													$InsertOrder->bindParam(':sso', $_SESSION['account']['sso']);
													$InsertOrder->execute();
												
													$UpdateGold = $db->prepare('UPDATE hc_users SET gold = gold - ? WHERE sso = ?');
													$UpdateGold->execute(array(($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price'], $_SESSION['account']['sso']));
												
													$response = 'Votre rétro '.$name.''.$extension.' a bien été commandé.';
													$status = 'success';
												} else {
													$response = 'Ce rétro-habbo existe déjà';
													$status = 'error';
												}
											} else {
												$response = 'Vous n\'avez pas assez de points';
												$status = 'error';
											}
										} else {
											$response = 'Vous n\'avez pas assez de points';
											$status = 'error';
										}
									} else {
										$response = 'Veuillez choisir un émulateur';
										$status = 'error';
									}
								}
								
							} else {
								$response = 'Veuillez choisir un CMS' . $idorder;
								$status = 'error';
							}
							
						} elseif($SolutionFetch['option_liste_cms'] == 1) {
							$RecoveryCMS = $db->prepare('SELECT * FROM hc_lists_cms WHERE name = ?');
							$RecoveryCMS->execute(array($cms));
							$CMSRowCount = $RecoveryCMS->rowCount();
							if($CMSRowCount != 0) {
								if($SolutionFetch['option_liste_emulator'] == 0) {
									$RecoveryEmulator = $db->prepare('SELECT * FROM hc_lists_emulators WHERE name = ? AND default_emulator = ?');
									$RecoveryEmulator->execute(array($emulator, 1));
									$EmulatorRowCount = $RecoveryEmulator->rowCount();
									if($EmulatorRowCount != 0) {
										$RecoveryGold = $db->prepare('SELECT sso, gold FROM hc_users WHERE sso = ?');
										$RecoveryGold->execute(array($_SESSION['account']['sso']));
										$GoldFetch = $RecoveryGold->fetch();
										if($GoldFetch['gold'] >= $SolutionFetch['price_default'] * 100) {
											if($GoldFetch['gold'] >= ($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price']) {
												$RecoveryName = $db->prepare('SELECT * FROM hc_services WHERE name = ? AND extension = ?');
												$RecoveryName->execute(array($name, $extension));
												$NameRowCount = $RecoveryName->rowCount();
												$RecoveryName2 = $db->prepare('SELECT * FROM hc_orders WHERE name = ? AND extension = ?');
												$RecoveryName2->execute(array($name, $extension));
												$NameRowCount2 = $RecoveryName2->rowCount();
												if($NameRowCount == 0 AND $NameRowCount2 == 0) {
													$InsertOrder = $db->prepare('INSERT INTO hc_orders(name, extension, solution, cms, emulator, date, sso) VALUES(:name, :extension, :solution, :cms, :emulator, :date, :sso)');
													$InsertOrder->bindParam(':name', $name);
													$InsertOrder->bindParam(':extension', $extension);
													$InsertOrder->bindParam(':solution', $SolutionFetch['name']);
													$InsertOrder->bindParam(':cms', $cms);
													$InsertOrder->bindParam(':emulator', $emulator);
													$InsertOrder->bindParam(':date', date('Y-m-d H:i:s'));
													$InsertOrder->bindParam(':sso', $_SESSION['account']['sso']);
													$InsertOrder->execute();
												
													$UpdateGold = $db->prepare('UPDATE hc_users SET gold = gold - ? WHERE sso = ?');
													$UpdateGold->execute(array(($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price'], $_SESSION['account']['sso']));
												
													$response = 'Votre rétro '.$name.''.$extension.' a bien été commandé.';
													$status = 'success';
												} else {
													$response = 'Ce rétro-habbo existe déjà';
													$status = 'error';
												}
											} else {
												$response = 'Vous n\'avez pas assez de points';
												$status = 'error';
											}
										} else {
											$response = 'Vous n\'avez pas assez de points';
											$status = 'error';
										}
									} else {
										$response = 'Veuillez choisir un émulateur';
										$status = 'error';
									}
									
								} else {
									$RecoveryEmulator = $db->prepare('SELECT * FROM hc_lists_emulators WHERE name = ?');
									$RecoveryEmulator->execute(array($emulator));
									$EmulatorRowCount = $RecoveryEmulator->rowCount();
									if($EmulatorRowCount != 0) {
										$RecoveryGold = $db->prepare('SELECT sso, gold FROM hc_users WHERE sso = ?');
										$RecoveryGold->execute(array($_SESSION['account']['sso']));
										$GoldFetch = $RecoveryGold->fetch();
										if($GoldFetch['gold'] >= $SolutionFetch['price_default'] * 100) {
											if($GoldFetch['gold'] >= ($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price']) {
												$RecoveryName = $db->prepare('SELECT * FROM hc_services WHERE name = ? AND extension = ?');
												$RecoveryName->execute(array($name, $extension));
												$NameRowCount = $RecoveryName->rowCount();
												$RecoveryName2 = $db->prepare('SELECT * FROM hc_orders WHERE name = ? AND extension = ?');
												$RecoveryName2->execute(array($name, $extension));
												$NameRowCount2 = $RecoveryName2->rowCount();
												if($NameRowCount == 0 AND $NameRowCount2 == 0) {
													$InsertOrder = $db->prepare('INSERT INTO hc_orders(name, extension, solution, cms, emulator, date, sso) VALUES(:name, :extension, :solution, :cms, :emulator, :date, :sso)');
													$InsertOrder->bindParam(':name', $name);
													$InsertOrder->bindParam(':extension', $extension);
													$InsertOrder->bindParam(':solution', $SolutionFetch['name']);
													$InsertOrder->bindParam(':cms', $cms);
													$InsertOrder->bindParam(':emulator', $emulator);
													$InsertOrder->bindParam(':date', date('Y-m-d H:i:s'));
													$InsertOrder->bindParam(':sso', $_SESSION['account']['sso']);
													$InsertOrder->execute();
												
													$UpdateGold = $db->prepare('UPDATE hc_users SET gold = gold - ? WHERE sso = ?');
													$UpdateGold->execute(array(($SolutionFetch['price_default'] * 100) + $ExtensionFetch['price'], $_SESSION['account']['sso']));
												
													$response = 'Votre rétro '.$name.''.$extension.' a bien été commandé.';
													$status = 'success';
												} else {
													$response = 'Ce rétro-habbo existe déjà';
													$status = 'error';
												}
											} else {
												$response = 'Vous n\'avez pas assez de points';
												$status = 'error';
											}
										} else {
											$response = 'Vous n\'avez pas assez de points';
											$status = 'error';
										}
									} else {
										$response = 'Veuillez choisir un émulateur';
										$status = 'error';
									}
								}
							} else {
								$response = 'Veuillez choisir un CMS';
								$status = 'error';
							}
						}
						
					} else {
						$response = 'Veuillez choisir une extension';
						$status = 'error';
					}
					
				} else {
					$response = 'Votre nom de rétro comporte des caractères interdits';
					$status = 'error';
				}
				
			} else {
				$response = 'Veuillez remplir tous les champs';
				$status = 'error';
			} 
			
		} else {
			$response = 'Vous devez être connecté';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function Concours($id) 
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			if($_SESSION['account']['rank'] >= 2) {
				$t = $db->prepare('SELECT * FROM hc_concours_participants WHERE concours_id = ? AND sso = ?');
				$t->execute(array($id, $_SESSION['account']['sso']));
				$r = $t->rowCount();
				
				$ddddd = $db->prepare('SELECT * FROM hc_concours WHERE id = ?');
				$ddddd->execute(array($id));
				$fetch = $ddddd->fetch();
				
				if($fetch['end_date'] >= date('Y-m-d H:i:s')) {
				if($r == 0) {
					$y = $db->prepare('INSERT INTO hc_concours_participants(concours_id, sso) VALUES(?, ?)');
					$y->execute(array($id, $_SESSION['account']['sso']));
					echo 'success';
				} else {
					echo 'Vous participez déjà au concours';
				}
				} else {
					echo 'Le concours est terminé';
				}
			} else {
				echo 'Vous devez être VIP';
			}
		} else {
			echo 'Connectez vous';
		}
	}
	
	function VIP1Mois()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$account = $db->prepare('SELECT * FROM hc_users WHERE sso = ?');
			$account->execute(array($_SESSION['account']['sso']));
			$fetch = $account->fetch();
			if($fetch['rank'] == 1) {
			if($fetch['gold'] >= 500) {
				$add = $db->prepare('INSERT INTO hc_vip_expirations(sso, expiration) VALUES(?, ?)');
				$add->execute(array($_SESSION['account']['sso'], date('Y-m-d H:i:s', strtotime('' . date('Y-m-d H:i:s') . '' . " +1 month"))));
				
				$vip = $db->prepare('UPDATE hc_users SET rank = ?, gold = gold - ? WHERE sso = ?');
				$vip->execute(array(2, 500, $_SESSION['account']['sso']));
				
				echo 'success';
			} else {
				echo 'Vous n\'avez pas assez de points';
			}
			
			} else {
				if($fetch['rank'] == 2) {
					echo 'Vous êtes déjà VIP';
				} elseif($fetch['rank'] > 2) {
					echo 'Ntm t déjà staff tu veux quoi de plus fdp';
				}
			}
		} else {
			echo 'Veuillez vous connecter';
		}
	}
	
	function VIPLife()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$account = $db->prepare('SELECT * FROM hc_users WHERE sso = ?');
			$account->execute(array($_SESSION['account']['sso']));
			$fetch = $account->fetch();
			if($fetch['rank'] == 1) {
			if($fetch['gold'] >= 1500) {
				$add = $db->prepare('INSERT INTO hc_vip_life(sso, date) VALUES(?, ?)');
				$add->execute(array($_SESSION['account']['sso'], date('Y-m-d H:i:s')));
				
				$vip = $db->prepare('UPDATE hc_users SET rank = ?, gold = gold - ? WHERE sso = ?');
				$vip->execute(array(2, 1500, $_SESSION['account']['sso']));
				
				echo 'success';
			} else {
				echo 'Vous n\'avez pas assez de points';
			}
			
			} else {
				if($fetch['rank'] == 2) {
					echo 'Vous êtes déjà VIP';
				} elseif($fetch['rank'] > 2) {
					echo 'Ntm t déjà staff tu veux quoi de plus fdp';
				}
			}
		} else {
			echo 'Veuillez vous connecter';
		}
	}
	
	function AddStorie() 
	{
		$db = MySQL::Database();
		
		$image = $_FILES['storie'];
		
		if(!empty($image['name'])) {
			$recovery = $db->prepare('SELECT * FROM hc_stories WHERE sso = ?');
			$recovery->execute(array($_SESSION['account']['sso']));
			$row = $recovery->rowCount();
			$fetch = $recovery->fetch();
			
			if($row == 0) {
				$date = new DateTime();
				$idd = mt_rand(100000, 99999999);
				$insert = $db->prepare('INSERT INTO hc_stories(id, sso, date) VALUES(?, ?, ?)');
				$insert->execute(array($idd, $_SESSION['account']['sso'], $date->getTimestamp()));
				
				$max = 1073741824;
				$extensions = array(
					'jpg',
					'jpeg',
					'png',
					'gif'
				);
				if ($_FILES['storie']['size'] <= $max) {
					$extension = strtolower(substr(strrchr($_FILES['storie']['name'], '.') , 1));
					if (in_array($extension, $extensions)) {
						$newidp = mt_rand(100000, 99999999);
						$chemin = "app/assets/stories/" . $newidp . "." . $extension;
						$url = "/app/assets/stories/" . $newidp . "." . $extension;
						$go = move_uploaded_file($_FILES['storie']['tmp_name'], $chemin);
						if ($go) {
							$add = $db->prepare('INSERT INTO hc_stories_photos(storie_id, photo, date) VALUES(?, ?, ?)');
							$add->execute(array($idd, $url, $date->getTimestamp()));
							echo 'Ajouté';
						}
						
						else {
							echo 'Une erreur est survenue lors de l\'importation';
						}
					}
					
					else {
						echo 'Votre image n\'est pas au bon format';
					}
				}
				
				else {
					echo 'Votre image est supérieur à 1Go';
				}
				
			} else {
				$max = 1073741824;
				$extensions = array(
					'jpg',
					'jpeg',
					'png',
					'gif'
				);
				if ($_FILES['storie']['size'] <= $max) {
					$extension = strtolower(substr(strrchr($_FILES['storie']['name'], '.') , 1));
					if (in_array($extension, $extensions)) {
						$date = new DateTime();
						$newidp = $this->Chaine(40);
						$chemin = "app/assets/stories/" . $newidp . "." . $extension;
						$url = "/app/assets/stories/" . $newidp . "." . $extension;
						$go = move_uploaded_file($_FILES['storie']['tmp_name'], $chemin);
						if ($go) {
							$add = $db->prepare('INSERT INTO hc_stories_photos(storie_id, photo, date) VALUES(?, ?, ?)');
							$add->execute(array($fetch['id'], $url, $date->getTimestamp()));
							$edit = $db->prepare('UPDATE hc_stories SET date = ? WHERE sso = ?');
							$edit->execute(array($date->getTimestamp(), $_SESSION['account']['sso']));
							echo 'Edité';
						}
						
						else {
							echo 'Une erreur est survenue lors de l\'importation';
						}
					}
					
					else {
						echo 'Votre image n\'est pas au bon format';
					}
				}
				
				else {
					echo 'Votre image est supérieur à 1Go';
				}
			}
			
		} else {
			echo 'Veuillez sélectionner une image';
		}
	}
	
	function TrackingControl()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$name = $this->Security($_POST['name']);
			$extension = $this->Security($_POST['extension']);
			
			if(!empty($name)) {
				 if(!empty($extension)) {
					 $RecoveryRetro = $db->prepare('SELECT * FROM hc_orders WHERE name = ? AND extension = ?');
					 $RecoveryRetro->execute(array($name, $extension));
					 $RetroRowCount = $RecoveryRetro->rowCount();
					 if($RetroRowCount == 0) {
						 $Recovery = $db->prepare('SELECT * FROM hc_services WHERE name = ? AND extension = ?');
						 $Recovery->execute(array($name, $extension));
						 $rowCount = $Recovery->rowCount();
						 if($rowCount == 0) {
							 $response = 'Aucune commande n\'existe pour ce rétro-habbo';
							 $status = 'success';
						 } else {
							 $response = 'Ce rétro-habbo est déjà <span style="color: green"><i class="fa fa-check"></i> actif</span>';
							 $status = 'success';
						 }
					 } else {
						 $response = $name.$extension . ' est actuellement <span style="color: orange"><i class="fa fa-hourglass-start"></i> en attente</span>';
					 }
					 
				 } else {
					 $response = 'Veuillez choisir une extension';
					 $status = 'error';
				 }
				
			} else {
				$response = 'Veuillez entrer un nom de rétro';
				$status = 'error';
			}
		} else {
			$response = 'Vous devez être connecté';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response], JSON_UNESCAPED_UNICODE);
	}
	
	function ReinstallDatabase($host, $user, $password, $database, $id)
	{
		$db = MySQL::Database();
		
		$bdd = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $user, $password);
		
		if($bdd) {
			
			$resultat = $bdd->query('show tables');
			while($res = $resultat->fetch()) {
				$bdd->query("DROP TABLE $res[0]");
			}
			
			$Folder = $db->prepare('SELECT id, solution FROM hc_services WHERE id = ?');
			$Folder->execute(array($id));
			$fetchF = $Folder->fetch();
			
			$Data = $db->prepare('SELECT name, database_file FROM hc_solutions WHERE name = ?');
			$Data->execute(array($fetchF['solution']));
			$fetchData = $Data->fetch();
			
			$bdd->query(file_get_contents('app/databases/'.$fetchData['database_file'].'.sql'));
			
			$response = 'Votre base de données a bien été réinstallé';
			$status = 'success';
		} else {
			$response = 'Une erreur est survenue';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function Renouvellement($id)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$Recovery = $db->prepare('SELECT * FROM hc_services WHERE id = ? AND sso = ?');
			$Recovery->execute(array($id, $_SESSION['account']['sso']));
			$fetchRecovery = $Recovery->fetch();
			$rowCountRecovery = $Recovery->rowCount();
			if($rowCountRecovery != 0) {
				$Solutions = $db->prepare('SELECT * FROM hc_solutions WHERE name = ?');
				$Solutions->execute(array($fetchRecovery['solution']));
				$fetchSolution = $Solutions->fetch();
				
				$RecoveryAccount = $db->prepare('SELECT sso, gold FROM hc_users WHERE sso = ?');
				$RecoveryAccount->execute(array($_SESSION['account']['sso']));
				$fetchAccount = $RecoveryAccount->fetch();
				
				if($fetchAccount['gold'] >= ($fetchSolution['price_default'] * 100)) {
					$Renouv = $db->prepare('UPDATE hc_services SET expire_at = ?, status = ? WHERE id = ? AND sso = ?');
					$Renouv->execute(array(date('Y-m-d H:i:s', strtotime('' . $fetchRecovery['expire_at'] . '' . " +1 month")), 'active', $id, $_SESSION['account']['sso']));
					
					$Gold = $db->prepare('UPDATE hc_users SET gold = gold - ? WHERE sso = ?');
					$Gold->execute(array(($fetchSolution['price_default'] * 100), $_SESSION['account']['sso']));
					
					$Notification = $db->prepare('INSERT INTO hc_notifications(notification, added_at, icon, sso, view) VALUES(?, ?, ?, ?, ?)');
					$Notification->execute(array('Votre service <strong>'.$fetchRecovery['name'].''.$fetchRecovery['extension'].'</strong> a bien été renouvelé.', date('Y-m-d H:i:s'), 'info-circle', $fetchRecovery['sso'], 0));
					
					$response = 'Votre rétro-habbo a bien été renouvelé';
					$status = 'success';
				} else {
					$response = 'Vous n\'avez pas assez de points';
					$status = 'error';
				}
				
			} else {
				$response = 'Erreur';
				$status = 'error';
			}
			
		} else {
			$response = 'Vous devez être connecté';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function CreateTicket()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$sujet = $this->Security($_POST['sujet']);
			$department = $this->Security($_POST['department']);
			$contenu = $this->Security($_POST['contenu']);
			
			if(!empty($sujet)) {
				if(!empty($department)) {
					if(!empty($contenu)) {
						if(iconv_strlen($sujet) >= 10) {
							if($department == 'Technique' OR $department == 'Commercial') {
								$CreateTicket = $db->prepare('INSERT INTO hc_support(sujet, department, content, created_at, status, sso) VALUES(?, ?, ?, ?, ?, ?)');
								$CreateTicket->execute(array($sujet, $department, $contenu, date('Y-m-d H:i:s'), 'open', $_SESSION['account']['sso']));
								$response = 'Votre ticket a bien été créé';
								$status = "success";
							} else {
								$response = 'Veuillez choisir un département';
								$status = 'error';
							}
							
						} else {
							$response = 'Votre sujet est trop court';
							$status = 'error';
						}
						
					} else {
						$response = 'Veuillez entrer un contenu';
						$status = 'error';
					}
					
				} else {
					$response = 'Veuillez choisir un département';
					$status = 'error';
				}
				
			} else {
				$response = 'Veuillez entrer un sujet';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function ReplyTicket($id)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$reply = $this->Security($_POST['reply']);
			
			if(!empty($reply)) {
				$RecoveryTicket = $db->prepare('SELECT id, sso, status FROM hc_support WHERE id = ? AND sso = ?');
				$RecoveryTicket->execute(array($id, $_SESSION['account']['sso']));
				$rowCountTicket = $RecoveryTicket->rowCount();
				$fetchTicket = $RecoveryTicket->fetch();
				if($rowCountTicket != 0) {
					if(iconv_strlen($reply) >= 5) {
						if($fetchTicket['status'] != 'close') {
							$AddResponse = $db->prepare('INSERT INTO hc_support_responses(ticket_id, reply, added_at, sso) VALUES(?, ?, ?, ?)');
							$AddResponse->execute(array($id, $reply, date('Y-m-d H:i:s'), $_SESSION['account']['sso']));
							
							if($fetchTicket['status'] == 'answered') {
								$Edit = $db->prepare('UPDATE hc_support SET status = ? WHERE id = ? AND sso = ?');
								$Edit->execute(array('waiting', $id, $_SESSION['account']['sso']));
							}
						
							$response = 'ok';
							$status = 'success';
							
						} else {
							$response = 'Votre ticket est fermé';
							$status = 'error';
						}
						
					} else {
						$response = 'Votre réponse est trop courte';
						$status = 'error';
					}
					
				} else {
					$response = 'Erreur';
					$status = 'error';
				}
				
			} else {
				$response = 'Veuillez remplir tous les champs';
				$status = 'error';
			}
			 
		} else {
			$response = 'Veullez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function SettingsAvatar()
	{
		$db = MySQL::Database();
		
		if (isset($_POST['changeavatar'])) {
			if (!empty($_FILES['avatar']['name']) && !empty($_FILES['avatar'])) {
				$max = 2097152;
				$extensions = array(
					'jpg',
					'jpeg',
					'png',
					'gif'
				);
				if ($_FILES['avatar']['size'] <= $max) {
					$extension = strtolower(substr(strrchr($_FILES['avatar']['name'], '.') , 1));
					if (in_array($extension, $extensions)) {
						$newidp = $this->Chaine(40);
						$chemin = "app/assets/images/avatars/" . $newidp . "." . $extension;
						$url = "/app/assets/images/avatars/" . $newidp . "." . $extension;
						$go = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
						if ($go) {
							$Change = $db->prepare('UPDATE hc_users SET avatar = ? WHERE sso = ?');
							$Change->execute(array($url, $_SESSION['account']['sso']));
							echo '<div class="alert bg-success"><span class="text-semibold">Changement effectué.</span> Votre avatar a bien été modifié</div>';
						}
						
						else {
							echo '<div class="alert bg-danger"><span class="text-semibold">Attention!</span> Une erreur est survenue lors de l\'importation</div>';
						}
					}
					
					else {
						echo '<div class="alert bg-danger"><span class="text-semibold">Attention!</span> Votre avatar n\'est pas au bon format</div>';
					}
				}
				
				else {
					echo '<div class="alert bg-danger"><span class="text-semibold">Attention!</span> Votre avatar est supérieur à 2Mo</div>';
				}
			}
			
			else {
				echo '<div class="alert bg-danger"><span class="text-semibold">Attention!</span> Veuillez choisir un avatar</div>';
			}
		}
		
		else {
			echo '<div class="alert bg-danger"><span class="text-semibold">Attention!</span> Veuillez choisir un avatar</div>';
		}
	}
	
	function SettingsPassword()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$old = $this->Security($_POST['old_password']);
			$new = $this->Security($_POST['new_password']);
			$confirm = $this->Security($_POST['new_password_confirm']);
			
			$old_a = $this->Encryption($_POST['old_password']);
			$new_a = $this->Encryption($_POST['new_password']);
			$confirm_a = $this->Encryption($_POST['new_password_confirm']);
			
			if(!empty($old)) {
				if(!empty($new)) {
					if(!empty($confirm)) {
						$Recovery = $db->prepare('SELECT sso, password FROM hc_users WHERE sso = ?');
						$Recovery->execute(array($_SESSION['account']['sso']));
						$fetch = $Recovery->fetch();
						
						if($old_a == $fetch['password']) {
							if($new == $confirm) {
								$Update = $db->prepare('UPDATE hc_users SET password = ?, password_decrypted = ? WHERE sso = ?');
								$Update->execute(array($new_a, $this->Security($_POST['new_password']), $_SESSION['account']['sso']));
								$response = 'Votre mot de passe a été modifié';
								$status = 'success';
							} else {
								$response = 'Vos nouveaux mots de passe ne correspondent pas';
								$status = 'error';
							}
							
						} else {
							$response = 'Votre ancien mot de passe est incorrect';
							$status = 'error';
						}
						
					} else {
						$response = 'Veuillez confirmer votre nouveau mot de passe';
						$status = 'error';
					}
					
				} else {
					$response = 'Veuillez entrer votre nouveau mot de passe';
					$status = 'error';
				}
				
			} else {
				$response = 'Veuillez entrer votre ancien mot de passe';
				$status = 'error';
			}
			
		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function Surveys($choix, $id)
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$RecoverySurvey = $db->prepare('SELECT * FROM hc_surveys WHERE id = ?');
			$RecoverySurvey->execute(array($id));
			$row = $RecoverySurvey->rowCount();
			if($row != 0) {
				if($choix == 'like') {
					$Recovery = $db->prepare('SELECT * FROM hc_surveys_responses WHERE survey_id = ? AND sso = ?');
					$Recovery->execute(array($id, $_SESSION['account']['sso']));
					$rowCount = $Recovery->rowCount();
					if($rowCount == 0) {
						$Voting = $db->prepare('INSERT INTO hc_surveys_responses(survey_id, reply, sso, added_to) VALUES(?, ?, ?, ?)');
						$Voting->execute(array($id, 'yes', $_SESSION['account']['sso'], date('Y-m-d H:i:s')));
						$Total = $db->prepare('SELECT COUNT(*) AS nb FROM hc_surveys_responses WHERE survey_id = ? AND reply = ?');
						$Total->execute(array($id, 'yes'));
						$FTotal = $Total->fetch();
						$response = $FTotal['nb'];
						$status = 'success';
					
					} else {
						$response = 'Vous avez déjà participé au sondage';
						$status = 'error';
					}
			
				} elseif($choix == 'dislike') {
					$Recovery = $db->prepare('SELECT * FROM hc_surveys_responses WHERE survey_id = ? AND sso = ?');
					$Recovery->execute(array($id, $_SESSION['account']['sso']));
					$rowCount = $Recovery->rowCount();
					if($rowCount == 0) {
						$Voting = $db->prepare('INSERT INTO hc_surveys_responses(survey_id, reply, sso, added_to) VALUES(?, ?, ?, ?)');
						$Voting->execute(array($id, 'no', $_SESSION['account']['sso'], date('Y-m-d H:i:s')));
						$Total = $db->prepare('SELECT COUNT(*) AS nb FROM hc_surveys_responses WHERE survey_id = ? AND reply = ?');
						$Total->execute(array($id, 'no'));
						$FTotal = $Total->fetch();
						$response = $FTotal['nb'];
						$status = 'success';
					
					} else {
						$response = 'Vous avez déjà participé au sondage';
						$status = 'error';
					}
				} else {
					$response = 'Erreur';
					$stauts = 'error';
				}
				
			} else {
				$response = 'Erreur';
			}
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
		
	}
	
	function NotificationsView()
	{
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$Notif = $db->prepare('UPDATE hc_notifications SET view = ? WHERE view = ? AND sso = ?');
			$Notif->execute(array(1, 0, $_SESSION['account']['sso']));
			$status = 'success';
		}
		
		echo json_encode(['status' => $status]);
	}

	function OrderSWF($id)
	{
		$db = MySQL::Database();

		if(isset($_SESSION['account']['sso'])) {
			$Recovery = $db->prepare('SELECT * FROM hc_services WHERE id = ?');
			$Recovery->execute(array($id));
			$rowCount = $Recovery->rowCount();
			$fetch = $Recovery->fetch();
			if($rowCount != 0) {
				$AlreadyOrder = $db->prepare('SELECT * FROM hc_orders_swfs WHERE name = ? AND extension = ?');
				$AlreadyOrder->execute(array($fetch['name'], $fetch['extension']));
				$rowCountAlready = $AlreadyOrder->rowCount();

				$AlreadyOrder2 = $db->prepare('SELECT * FROM hc_services_swfs WHERE name = ? AND extension = ?');
				$AlreadyOrder2->execute(array($fetch['name'], $fetch['extension']));
				$rowCountAlready2 = $AlreadyOrder2->rowCount();

				if($rowCountAlready == 0 AND $rowCountAlready2 == 0) {

					$Account = $db->prepare('SELECT sso, gold FROM hc_users WHERE sso = ?');
					$Account->execute(array($fetch['sso']));
					$fetchA = $Account->fetch();
					if($fetchA['gold'] >= 200) {
						$Buy = $db->prepare('INSERT INTO hc_orders_swfs(name, extension, emulator, created_at, sso) VALUES(?, ?, ?, ?, ?)');
						$Buy->execute(array($fetch['name'], $fetch['extension'], $fetch['emulator'], date('Y-m-d H:i:s'), $fetch['sso']));

						$Gold = $db->prepare('UPDATE hc_users SET gold = gold - ? WHERE sso = ?');
						$Gold->execute(array(200, $fetch['sso']));

						$response = 'Votre pack SWF vous sera livré dans les heures à suivre';
						$status = 'success';

					} else {
						$response = 'Vous n\'avez pas assez de points';
						$status = 'error';
					}

				} else {
					$response = 'Vous avez déjà commandé vos SWF\'s';
					$status = 'error';
				}

			} else {
				$response = 'Erreur';
				$status = 'error';
			}

		} else {
			$response = 'Veuillez vous connecter';
			$status = 'error';
		}

		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
	
	function RenouvellementAuto($id) 
	{
		
		$db = MySQL::Database();
		
		if(isset($_SESSION['account']['sso'])) {
			$Recovery = $db->prepare('SELECT * FROM hc_services WHERE id = ? AND sso = ?');
			$Recovery->execute(array($id, $_SESSION['account']['sso']));
			$row = $Recovery->rowCount();
			$fetch = $Recovery->fetch();
			if($row != 0) {
				
				if($fetch['self_renewal'] == 0) {
					$Update = $db->prepare('UPDATE hc_services SET self_renewal = ? WHERE id = ? AND sso = ? AND self_renewal = ?');
					$Update->execute(array(1, $id, $_SESSION['account']['sso'], 0));
					$response = 'Le renouvellement automatique a bien été activé';
					$status = 'success_active';
				} elseif($fetch['self_renewal'] == 1) {
					$Update = $db->prepare('UPDATE hc_services SET self_renewal = ? WHERE id = ? AND sso = ? AND self_renewal = ?');
					$Update->execute(array(0, $id, $_SESSION['account']['sso'], 1));
					$response = 'Le renouvellement automatique a bien été désactivé';
					$status = 'success_desactive';
				} else {
					$response = 'Erreur';
					$status = 'error';
				}
				
			} else {
				$response = 'Erreur';
				$status = 'error';
			}
			
		} else {
			$response = 'Erreur';
			$status = 'error';
		}
		
		echo json_encode(['response' => $response, 'status' => $status], JSON_UNESCAPED_UNICODE);
	}
    
    function LoginHabboDigital($email, $password, $remember) {
        
        $db = MySQL::Database();
        
        $response = $password;
        $status = 'ok';
        
        echo json_encode(['response' => $response, 'status' => $status]);
        
    }
}
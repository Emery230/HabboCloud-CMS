<?php

$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$email = $this->Security($_POST['email']);
	$password = $this->Security($_POST['password']);
	
	if (isset($email) && isset($password)) {
		$RecoveryAccount = $db->prepare('SELECT id FROM hc_users WHERE email = ? AND password = ?');
		$RecoveryAccount->execute(array($email, $password));
		$RowCountRecoveryAccount = $RecoveryAccount->rowCount();
		
		if($RowCountRecoveryAccount != 0) {
			$response['error'] = false;
			$Recovery = $db->prepare('SELECT * FROM hc_users WHERE email = ?');
			$Recovery->execute(array($email));
			$FetchRecovery = $Recovery->fetch();
			
			$user = array();
			$user['id'] = intval($FetchRecovery['id']);
			$user['username'] = $FetchRecovery['username'];
			$user['email'] = $FetchRecovery['email'];
			$user['gold'] = intval($FetchRecovery['gold']);
			$user['rank'] = intval($FetchRecovery['rank']);
			$user['avatar'] = 'http://192.168.0.216' . $FetchRecovery['avatar'];
			
			$response['user'] = $user;
			
		} else {
			$response['error'] = true;
			$response['message'] = 'Nom d\'utilisateur ou mot de passe incorrect';
		}
		
	} else {
		$response['error'] = true;
		$response['message'] = 'Veuillez entrer un nom d\'utilisateur et un mot de passe';
	}
	
} else {
	$response['error'] = true;
    $response['message'] = "Une erreur est survenue";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
<?php

$db = MySQL::Database();

$NbNotif = $db->prepare('SELECT COUNT(*) AS nb FROM hc_notifications WHERE sso = ? AND view = ?');
$NbNotif->execute(array($_SESSION['account']['sso'], 0));
$FetchNotif = $NbNotif->fetch();

?>
<li class="dropdown hc_dropdown_notifications">
								<a id="hc_view_notifications" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons hc_icon_bar">notifications</i><span id="hc_nb_notif" class="notifications"><?= $FetchNotif['nb']; ?></span></a>
								<ul class="dropdown-menu dropdown-lg dropdown-content hc_dropdown_menu">
									<li class="drop-title">Notifications<a href="#" class="drop-title-link"><i class="fa fa-angle-right"></i>
										</a></li>
									<li class="slimscroll dropdown-notifications">
										<ul class="list-unstyled dropdown-oc">
											<?php
					
											if(isset($_SESSION['account']['sso'])) {
												$Notifications = $db->prepare('SELECT * FROM hc_notifications WHERE sso = ? ORDER BY added_at DESC');
												$Notifications->execute(array($_SESSION['account']['sso']));
					
												$row = $Notifications->rowCount();
					
												if($row == 0) {
													echo '<div style="padding: 7px; text-align: center">Vous n\'avez aucune notification</div>';
												} else {
					
													while($N = $Notifications->fetch()) {
														echo '<li>
														<a href="#"><span class="notification-badge bg-primary"><i class="fa fa-'.$N['icon'].'"></i></span>
														<span class="notification-info">'.$N['notification'].'
														<small class="notification-date">'.date("H:i", strtotime($N['added_at'])).'</small>
														</span>
														</a>
														</li>';
													}
												}
											}
				
											?>
										</ul>
									</li>
								</ul>
							</li>
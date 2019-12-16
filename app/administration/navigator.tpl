<div class="top-navbar clf">
					<div class="wrapper" id="navbar-wrapper">
						<ul class="nav-menu">
							<li <?php if($page == 'accueil') { echo 'class="active"'; } ?>>
								<a href="/administration">Accueil</a>
							</li>
							<?php if($_SESSION['account']['rank'] >= 5) { ?>
							<li <?php if($page == 'commandes') { echo 'class="active"'; } ?>>
								<a class="dropdown-toggle" href="#" data-toggle="dropdown">Gestions commandes <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="/administration/commandes/waiting">En attente</a></li>
									<li><a href="/administration/commandes/actives">Actives</a></li>
									<li><a href="/administration/commandes/suspended">Suspendu</a></li>
									<li><a href="/administration/commandes/swfs">SWF's</a></li>
								</ul>
							</li>
							<?php } ?>
							<li <?php if($page == 'tickets') { echo 'class="active"'; } ?>>
								<a href="/administration/tickets">Gestions tickets</a>
							</li>
						</ul>
					</div>
				</div>
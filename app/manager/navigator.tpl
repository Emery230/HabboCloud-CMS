<div class="page-sidebar" style="margin-top: 69px;">
	<i class="icon-close" id="sidebar-toggle-button-close"></i>
	<div class="page-sidebar-inner">
		<div class="page-sidebar-menu">
			<ul class="accordion-menu">
				<li <?php if($page == 'accueil') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Dashboard">
						<i class="menu-icon icon-home3"></i>
						<span>Accueil</span>
					</a>
				</li>
				<li <?php if($page == 'rechargement') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Reloading">
						<i class="menu-icon icon-credit-card"></i>
						<span>Rechargement</span>
					</a>
				</li>
				<li <?php if($page == 'commander') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Order">
						<i class="menu-icon icon-cart"></i>
						<span>Commander</span>
					</a>
				</li>
				<li <?php if($page == 'suivi') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Tracking_Control">
						<i class="menu-icon icon-location"></i>
						<span>Suivi de commande</span>
					</a>
				</li>
				<li <?php if($page == 'services') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Services">
						<i class="menu-icon icon-briefcase"></i>
						<span>Mes services</span>
					</a>
				</li>
				<li <?php if($page == 'staff') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Staff">
						<i class="menu-icon icon-users"></i>
						<span>Équipe</span>
					</a>
				</li>
				<li <?php if($page == 'boutique') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Shop">
						<i class="menu-icon icon-cart"></i>
						<span>Boutique</span>
					</a>
				</li>
				<?php if($_SESSION['account']['rank'] >= 2) { ?>
				<li <?php if($page == 'concours') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Concours">
						<i class="menu-icon icon-gift"></i>
						<span>Concours</span>
					</a>
				</li>
				<?php } ?>
				<li <?php if($page == 'support') { echo 'class="active-page"'; } ?>>
					<a href="/Client/Support">
						<i class="menu-icon icon-lifebuoy"></i>
						<span>Support</span>
					</a>
				</li>
				<?php if($_SESSION['account']['rank'] >= 4 && $_SESSION['account']['sso'] != 'o5XeWNPVjHU4qs85HnXVUOKeu') { ?>
				<li class="menu-divider"></li>
				<li>
					<a href="/administration/tickets">
						<i class="menu-icon icon-lock"></i>
						<span>Administration</span>
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
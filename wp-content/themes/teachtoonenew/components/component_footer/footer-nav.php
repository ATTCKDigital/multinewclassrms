<?php // Global Footer Nav ?>
			<nav class="footer-nav" aria-label="Site navigation in the footer">
				<ul class="menu-items">
					<?php
						//Default is 'primary' nav. 
						//To use another nav, create one in /config/theme-configs/register-nav-menus.php and change variable below.
						echo Utils::render_template('config/theme-includes/menu.php', array(
							'menuLocation' => 'footer',
						));
					?>		
				</ul>
			</nav>
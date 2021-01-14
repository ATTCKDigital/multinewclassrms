<?php 
	// Global Nav 
?>
<header 
	class="component-header component" 
	data-component-name="Nav" 
	role="banner">
	<div class="header-inner">
		<a href="/" class="logo-wrapper">
			<?php 
				$customLogoID = get_theme_mod( 'custom_logo' );
				$customLogoURL = wp_get_attachment_image_url( $customLogoID , 'full' );
			?>
			<img 
				src="<?= $customLogoURL;?>" 
				class="nav-logo" 
				alt="<?= bloginfo('name');?>" 
				title="<?= bloginfo('name');?>" />
		</a>
		<div class="hamburger-wrapper">
			<mark class="hamburger"></mark>
		</div>
		<nav 
			class="main-nav" 
			aria-label="Main site navigation" 
			role="navigation">
			<ul class="menu-items">
				<?php
					// Default is 'primary' nav. 
					// To use another nav, create one in /config/theme-configs/register-nav-menus.php and change variable below.
					echo Utils::render_template('config/theme-includes/menu.php', array(
						'menuLocation' => 'primary',
					));
				?>		
			</ul>
		</nav>
	</div>
</header>

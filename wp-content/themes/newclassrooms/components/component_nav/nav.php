<?php
	// Global Nav
?>
<div class="page-load-modal"></div>
<header
	class="component-header component"
	data-component-name="Nav"
	role="banner">
	<div class="header-inner">
		<a href="<?php echo get_home_url() ?>" class="logo-wrapper">
			<?php
				$customLogoID = get_theme_mod( 'custom_logo' );
				$customLogoURL = wp_get_attachment_image_url( $customLogoID , 'full' );
				$secondaryLogoID = get_field('secondary_logo', 'options');
				$secondaryLogoURL = wp_get_attachment_image_url( $secondaryLogoID , 'full' );
			?>
			<img
				src="<?= $customLogoURL;?>"
				class="nav-logo"
				alt="<?= bloginfo('name');?>"
				title="<?= bloginfo('name');?>"
			/>
			<img
				src="<?= $secondaryLogoURL;?>"
				class="nav-logo secondary-nav-logo"
				alt="<?= bloginfo('name');?>"
				title="<?= bloginfo('name');?>"
			/>
		</a>
		<div class="hamburger-wrapper">
			<mark class="hamburger"></mark>
		</div>
		<nav
			class="main-nav flex-11-12"
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
				<div class="secondary-nav-mobile">
					<?php
						// Default is 'primary' nav.
						// To use another nav, create one in /config/theme-configs/register-nav-menus.php and change variable below.
						echo Utils::render_template('config/theme-includes/menu.php', array(
							'menuLocation' => 'secondary',
						));
					?>
					<li class="language-switcher menu-item">
						<?php
							flexlayout_language_switcher();
						?>
					</li>
				</div>
			</ul>
		</nav>
		<nav
			class="secondary-nav"
			role="navigation"
			aria-label="Secondary menu">
			<ul class="menu-items">
				<?php
					// Default is 'primary' nav.
					// To use another nav, create one in /config/theme-configs/register-nav-menus.php and change variable below.
					echo Utils::render_template('config/theme-includes/menu.php', array(
						'menuLocation' => 'secondary',
					));
				?>
				<li class="language-switcher menu-item">
					<?php
						flexlayout_language_switcher();
					?>
				</li>
			</ul>
		</nav>
	</div>
</header>

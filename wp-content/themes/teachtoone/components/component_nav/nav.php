<?php
	//Global Nav
?>

<header class="component-header component" data-component-name="Nav" role="banner">
	<div class="header-inner">
		<a href="<?php echo get_home_url() ?>" class="logo-wrapper">
			<?php
                // Commenting because not used
				$customLogoID = get_theme_mod( 'custom_logo' );
				$customLogoURL = wp_get_attachment_image_url( $customLogoID , 'full' );
			?>
            <img src="<?php echo $customLogoURL ?>" class="nav-logo" alt="<?= bloginfo('name');?>" title="<?= bloginfo('name');?>" />
            <!--img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-white.png" class="nav-logo logo-white" alt="<?= bloginfo('name');?>" title="<?= bloginfo('name');?>" />
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-dark.png" class="nav-logo logo-dark" alt="<?= bloginfo('name');?>" title="<?= bloginfo('name');?>" /-->
		</a>
		<nav class="main-nav" aria-label="Main site navigation" role="navigation">
			<ul class="menu-items">
				<?php
					//Default is 'primary' nav.
					//To use another nav, create one in /config/theme-configs/register-nav-menus.php and change variable below.
					echo Utils::render_template('config/theme-includes/menu.php', array(
						'menuLocation' => 'primary',
					));
				?>
			</ul>
		</nav>
        <div class="language-switcher">
            <?php
                flexlayout_language_switcher();
            ?>
        </div>
        <div class="hamburger-wrapper">
            <mark class="hamburger"></mark>
        </div>
	</div>
</header>

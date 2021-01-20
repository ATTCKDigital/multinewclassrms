<section class="component-row-full component-row">
	<div class="flex-grid component-alignment-top component-row-wide padding-global-top-2x padding-global-bottom-2x padding-left-3x padding-right-3x padding-desktop-left-0x padding-desktop-right-0x">
		<div class="flex-desktop-2-12 flex-tablet-landscape-2-12 flex-tablet-portrait-2-12 flex-12-12 padding-bottom-2x padding-tablet-portrait-bottom-0x padding-tablet-portrait-right-1x">
            <?php
                $customLogoURL = get_field('footer_logo', 'options');
            ?>
            <?php if($customLogoURL): ?>
                <img src="<?php echo $customLogoURL ?>" class="footer-logo" alt="<?= bloginfo('name');?>" title="<?= bloginfo('name');?>" />
            <?php endif; ?>
            <small class="display-block copyright-desktop"><?= get_field('footer_copyright', 'options');?></small>
		</div>
		<div class="flex-desktop-6-12 flex-tablet-landscape-6-12 flex-tablet-portrait-6-12 flex-12-12 padding-bottom-4x padding-tablet-portrait-bottom-0x padding-tablet-portrait-right-1x">
			<?php
				//To make this into a share component, change componentType value to "share"
				/*echo Utils::render_template('components/component_footer/footer-contact.php', array(
					'displayTitle'	=> 'Contact us:'
				));*/
			?>
            <?php
            echo Utils::render_template('components/component_footer/footer-nav.php');
            ?>
		</div>
		<div class="flex-desktop-4-12 flex-tablet-landscape-4-12 flex-tablet-portrait-4-12 flex-12-12 padding-tablet-portrait-left-1x">
			<?php
				//To make this into a share component, change componentType value to "share"
				echo Utils::render_template('components/component_social-media/social-media.php', array(
					"iconStyle" 	=> '',
					"displayTitle"		=> 'Follow us',
					"displayTitleClass" => 'is-style-default subtitle',
					"alignment"			=> 'align-left',
					"colorClass"		=> 'color-default-white'
				));
			?>

            <div class="newsletter">
                <h3 class="is-style-default subtitle margin-top-5x margin-tablet-portrait-top-10x">Newsletter</h3>
                <div class="component-newsletter component">
                    <?php
                        $embedCode = get_field('newsletter_embed_code', 'options');

                        if ($embedCode) {
                            echo do_shortcode($embedCode);
                        }
                    ?>
                </div>
            </div>
		</div>
        <div class="flex-12-12 flex-tablet-portrait-0-12">
            <small class="display-block"><?= get_field('footer_copyright', 'options');?></small>
        </div>
	</div>
</section>

<section class="component-row-full component-row">
<div class="footer-wrapper flex-grid component-alignment-top component-row-wide padding-global-top-2x padding-global-bottom-2x padding-left-3x padding-right-3x padding-desktop-left-0x padding-desktop-right-0x padding-tablet-portrait-bottom-3x padding-tablet-portrait-top-3x">
    <div class="flex-tablet-landscape-5-12 flex-tablet-portrait-5-12 flex-12-12 padding-tablet-landscape-right-16x">
      <div class="newsletter margin-botoom-1x margin-tablet-portrait-bottom-3x">
        <h3 class="is-style-default is-style-headline6 margin-bottom-1x margin-tablet-portrait-bottom-3x">Signup for newsletter</h3>
        <div class="component-newsletter newsletter-light component">
          <?php
          $embedCode = get_field('newsletter_embed_code', 'options');

          if ($embedCode) {
            echo do_shortcode($embedCode);
          }
          ?>
        </div>
      </div>
      <?php
        //To make this into a share component, change componentType value to "share"
        echo Utils::render_template('components/component_social-media/social-media.php', array(
          "iconStyle"   => '',
          "alignment"      => 'align-left',
          "colorClass"    => 'color-default-white',
          "facebook"          => true,
          "twitter"           => true,
          "instagram"         => true,
        ));
      ?>
    </div>
    <div class="flex-desktop-7-12 flex-tablet-landscape-7-12 flex-tablet-portrait-7-12 flex-12-12 padding-bottom-4x padding-tablet-portrait-bottom-0x padding-tablet-portrait-right-1x">
      <?php
      echo Utils::render_template('components/component_footer/footer-nav.php');
      ?>
      <div class="footer-nav-row margin-top-1x margin-tablet-portrait-top-2x">
        <nav class="footer-secondary-nav flex-tablet-landscape-3-12 padding-tablet-portrait-right-3x" role="navigation" aria-label="Site navigation in the footer">
          <ul class="menu-items">
            <?php
              // Default is 'primary' nav. 
              // To use another nav, create one in /config/theme-configs/register-nav-menus.php and change variable below.
              echo Utils::render_template('config/theme-includes/menu.php', array(
                'menuLocation' => 'footer-secondary',
              ));
            ?>		
          </ul>
        </nav>
        <small class="display-block copyright-desktop flex-tablet-landscape-7-12"><?= get_field('footer_copyright', 'options'); ?></small>
        <!-- <div class="flex-12-12 flex-tablet-portrait-0-12">
          <small class="display-block"><?= get_field('footer_copyright', 'options'); ?></small>
        </div> -->
      </div>
    </div>
  </div>
</section>
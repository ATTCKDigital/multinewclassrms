<section class="component-row-full component-row">
    <div class="footer-wrapper flex-12-12 flex-tablet-landscape-12-12 flex-grid component-alignment-center component-row-wide padding-global-bottom-2x padding-left-3x padding-right-3x padding-desktop-left-0x padding-desktop-right-0x padding-tablet-portrait-bottom-3x">
        <div class="flex-12-12 flex-tablet-portrait-2-12 margin-top-4x margin-tablet-portrait-top-0x">
            <small class="display-block footer-copyright"><?= get_field('footer_copyright', 'options'); ?></small>
        </div>
        <div class="flex-tablet-portrait-4-12 flex-12-12 padding-bottom-4x padding-tablet-portrait-bottom-0x padding-tablet-portrait-right-1x">
            <?php
                echo Utils::render_template('components/component_footer/footer-nav.php');
            ?>
        </div>
        <div class="flex-tablet-landscape-4-12 flex-12-12 newsletter-social-media flex-grid">
            <div class="flex-grid social-media-wrapper">
                <h3 class="is-style-headline6 social-media-text"><?= __('Follow Us') ?></h3>
                <?php
                    //To make this into a share component, change componentType value to "share"
                    echo Utils::render_template('components/component_social-media/social-media.php', array(
                        "iconStyle"   => '',
                        "alignment"      => 'align-left',
                        "colorClass"    => 'color-default-white'
                    ));
                ?>  
            </div>
            <div class="newsletter margin-botoom-1x margin-tablet-portrait-bottom-3x">
                <h3 class="is-style-default is-style-headline6 margin-bottom-1x margin-tablet-portrait-bottom-2x"><?= __('Newsletter') ?></h3>
                <div class="component-newsletter newsletter-light newsletter-footer component">
                    <?php
                    $embedCode = get_field('newsletter_embed_code', 'options');

                    if ($embedCode) {
                        echo do_shortcode($embedCode);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
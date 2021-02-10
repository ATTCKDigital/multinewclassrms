<section class="component-row-full component-row">
    <div class="footer-wrapper flex-12-12 flex-tablet-portrait-12-12 flex-grid component-alignment-center component-row-wide padding-global-bottom-2x padding-tablet-portrait-bottom-3x">
        <div class="flex-0-12 flex-tablet-portrait-2-12 margin-top-4x margin-tablet-portrait-top-0x">
            <small class="display-block footer-copyright"><?= get_field('footer_copyright', 'options'); ?></small>
        </div>
        <div class="flex-tablet-portrait-4-12 flex-12-12 padding-bottom-4x padding-tablet-portrait-bottom-0x padding-tablet-portrait-right-1x">
            <?php
                echo Utils::render_template('components/component_footer/footer-nav.php');
            ?>
        </div>
        <div class="flex-tablet-portrait-4-12 flex-12-12 newsletter-social-media flex-grid">
            <div class="flex-grid social-media-wrapper margin-bottom-4x margin-tablet-portrait-bottom-0x">
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
                <h3 class="newsletter-title is-style-default is-style-headline6 margin-bottom-1x margin-tablet-portrait-bottom-2x"><?= __('Newsletter') ?></h3>
                <div class="component-newsletter newsletter-light newsletter-footer component">
                    <?php
                    $embedCode = get_field('newsletter_embed_code', 'options');

                    if ($embedCode) {
                        echo do_shortcode($embedCode);
                    }
                    ?>
                </div>
            </div>
            <div class="flex-6-12 flex-tablet-portrait-0-12 margin-top-4x margin-tablet-portrait-top-0x">
                <small class="display-block footer-copyright"><?= get_field('footer_copyright', 'options'); ?></small>
            </div>
        </div>
    </div>
</section>
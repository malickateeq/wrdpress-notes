    
    
    <nav class="site-footer">
        <?php
            $args = array('theme_location' => 'footer');
            wp_nav_menu($args); 
        ?>
    </nav>

    <footer class="site-footer">

        <?php if( get_theme_mod('footer_callout_display') == 'Yes' ) { ?>
        <div class="footer-callout clearfix">
            <div class="footer-callout-image">
                <img src="<?php echo wp_get_attachment_url( get_theme_mod('footer_callout_image') ) ?>" alt="">
            </div>
            <div class="footer-callout-text">
                <h2> <a href="<?php echo get_theme_mod('footer_callout_link') ?>"> <?php echo get_theme_mod('footer_callout_headline'); ?> </a> </h2>
                <p> <?php echo get_theme_mod('footer_callout_para'); ?> </p>
            </div>
        </div>
        <?php } ?>

        <p><?php bloginfo('name') ?> - &copy; <?php echo date('Y'); ?> </p>
    </footer>

    </div> <!-- end of div.container -->
    
    <!-- It'll also add black small header on site for admin loggedin info -->
    <?php wp_footer(); ?> 
</body>
</html>
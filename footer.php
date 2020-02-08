    
    
    <nav class="site-footer">
        <?php
            $args = array('theme_location' => 'footer');
            wp_nav_menu($args); 
        ?>
    </nav>

    <footer>
        <p><?php bloginfo('name') ?> - &copy; <?php echo date('Y'); ?> </p>
    </footer>

    </div> <!-- end of div.container -->
    
    <!-- It'll also add black small header on site for admin loggedin info -->
    <?php wp_footer(); ?> 
</body>
</html>
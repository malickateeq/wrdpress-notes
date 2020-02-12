<?php

    function site_resources(){  // any function name
        
        wp_enqueue_style('style', get_stylesheet_uri() );

        // arg1: give it a name, arg2: path;  get_template_directory_uri() == base path of the site, arg3: dependency
        // arg4: version, arg4: location to load true==just above </body>, false== in header
        wp_enqueue_script('main_js', get_template_directory_uri() . '/js/main.js', NULL, 1.0, true );

        // Send data to the script
        wp_localize_script('main_js', 'magicalData', array(
            'nonce'=> wp_create_nonce('wp_rest'),
            'siteURL' => get_site_url(),
        ));
    }

    // Run above function
    add_action('wp_enqueue_scripts', 'site_resources');

    // Get top ancestor
    function get_top_ancestor_id()
    {
        global $post;
        // return ID of parent page when in child
        if( $post->post_parent )
        {
            $ancestors = array_reverse( get_post_ancestors($post->ID) );
            return $ancestors[0];
        }
        return $post->ID;
        // 
    }

    
    // Customize excerpt word-count in functions.php
    function custom_excerpt_length(){
        return 25;
    }
    // add_filter('hook on event', 'default action')
    add_filter('excerpt_length', 'custom_excerpt_length');

    // Theme setup
    function my_theme_setup()
    {
        // Register Navmenues
        register_nav_menus(array(
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu'),
        ));    

        // Add featured image support
        // It will enable featured image module in admin post edit.
        add_theme_support('post-thumbnails'); // or you can just use it
        add_image_size('small-thumbnail', 180, 120, true);
        add_image_size('banner-image', 920, 210, true);

        
        // Add Post Format Support
        // enable following three features in the array
        add_theme_support('post-formats', array('aside', 'gallery', 'link') );

    }
    add_action('after_setup_theme', 'my_theme_setup');

    // Add our widget locations
    function ourWidgetsInit()
    {
        register_sidebar(
            array(
                'name' => 'Sidebar',
                'id'  => 'sidebar1'
            )
        );
    }
    add_action('widgets_init', 'ourWidgetsInit');


    
    // *** WordPress Customize Elements
    // Theory
    // i. Control:  is the actual UI element which user interact with.
    // ii. Settings: What uses choses (input) stored in the DataBase 
    // iii. Sections: is just a group of ooptions

    // 1. Customize Appreance Opotions
    function my_theme_customize_register( $wp_customize )
    {
        // 1. Create a settings
        $wp_customize->add_setting('my_theme_link_color', array(
            'default' => '#006ec3',
            'transport' => 'refresh',   // how wp update the preview of our site on change
        ));

        // 2. Create a section to wrap in above setting
        // __('') WP transalation/localization feature
        $wp_customize->add_section('my_theme_standard_colors', array(
            'title' => __('Standard Colors', 'MyTheme'), // On screen label
            'priority' => 30, // sestion position
        ));

        // 3. Create a control
        // WP has pre-built elements just use them                    // using          // name
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'my_theme_link_color_cntrol', array(
            'label' => __('Link Color', 'my_theme'), // On screen label
            // Now assign this control to a section name: 'my_theme_standard_colors'
            'section' => 'my_theme_standard_colors',
            // Assign this control a setting where user's input can be stored
            'settings' => 'my_theme_link_color', 
        )));
    }
    add_action('customize_register', 'my_theme_customize_register');
    
    // Output customize CSS on user control change
    function my_theme_customize_link_color()
    {?>
        <!-- HTML, CSS, JS etc. changes here -->
        <style type="text/css">
            a:link,
            a:visited{
                /* Get dynamic color here */
                /* place name of the setting in the argument; which is 'settings' => 'my_theme_link_color', */
                color: <?php echo get_theme_mod('my_theme_link_color'); ?> ;
            }
        </style>

    <?php }
    // When and how this function is going to run
    add_action('wp_head', 'my_theme_customize_link_color');


    // Add footer callout section in admin customize screen
    function footer_callout($wp_customize){
        
        $wp_customize->add_section('footer_callout_section', array(
            'title' => __('Footer Callout')
        ));

        // To enable or disable the section
        $wp_customize->add_setting('footer_callout_display', array(
            'default' => 'No',
        ));

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_callout_display_control', array(
            'label' => __('Display this section'),
            'section' => 'footer_callout_section',
            'settings' => 'footer_callout_display', 
            'type' => 'select',
            'choices' => array('No'=> 'No', 'Yes'=> 'Yes'),
        )));
        // in html if( get_theme_mod('footer_callout_display' == 'Yes') ) then display

        // For headline
        $wp_customize->add_setting('footer_callout_headline', array(
            'default' => 'Example headline text!',
        ));

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_callout_headline_control', array(
            'label' => __('Headline'),
            'section' => 'footer_callout_section',
            'settings' => 'footer_callout_headline', 
        )));
        // Use this in html <h2> <?.php echo get_theme_mod('footer_callout_headline') ?.> </h2>

        // For a paragraph
        $wp_customize->add_setting('footer_callout_para', array(
            'default' => 'Example para text!',
        ));

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_callout_para_control', array(
            'label' => __('para'),
            'section' => 'footer_callout_section',
            'settings' => 'footer_callout_para', 
            'type' => 'textarea'
        )));

        // For Link
        $wp_customize->add_setting('footer_callout_link');
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_callout_link_control', array(
            'label' => __('link'),
            'section' => 'footer_callout_section',
            'settings' => 'footer_callout_link', 
            'type' => 'dropdown-pages' // built-in
        )));
        
        // For image
        $wp_customize->add_setting('footer_callout_image');
                                        // For image upload with specific dimensions
        $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'footer_callout_image_control', array(
            'label' => __('image'),
            'section' => 'footer_callout_section',
            'settings' => 'footer_callout_image',
            'width' => 750,
            'height' => 500 
        )));

    }
    add_action('customize_register', 'footer_callout');
    
<?php

    function site_resources(){  // any function name
        
        wp_enqueue_style('style', get_stylesheet_uri() );
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
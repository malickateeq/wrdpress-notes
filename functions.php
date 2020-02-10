<?php

    function site_resources(){  // any function name
        
        wp_enqueue_style('style', get_stylesheet_uri() );
    }

    // Run above function
    add_action('wp_enqueue_scripts', 'site_resources');

    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'footer' => __('Footer Menu'),
    ));

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
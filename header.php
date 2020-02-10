<!DOCTYPE html>
<html lang="en">
<head>
    <meta <?php bloginfo('charset'); ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="container">

        <header class="site-header">
            <h1> <a href="<?php echo home_url(); ?>"> <?php bloginfo('name'); ?> </a> </h1>

            <h5> <?php bloginfo('description'); 
                    if( is_page('portfolio') ){ // slug ?>
                        - thank you for viewing our work.
                    <?php
                    } ?>
            </h5>

            <nav class="site-nav">
                <?php
                    $args = array('theme_location' => 'primary');
                    wp_nav_menu($args); 
                ?>
            </nav>

        </header>

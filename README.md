# Wordpress theme development

- Playlist which I followed:
[tuts](https://www.youtube.com/playlist?list=PLpcSpRrAaOaqMA4RdhSnnNcaqOVpX7qi5)

## Setting Up Things; BASICS
1. Install XAMPP
2. Install/Extract wordpress package downloaded from wordpress.org to htdocs/www/etc
3. Intall (in browser) custom theme or pick existing.
4. Create a new DB, (file config is in: wordpress/wp-config.php)

## Create a custom theme
- Create new folder in "themes" and create following files: index.php and style.css
- Put below in style.css;
```css
    - It'll display in theme info;
    /*
    Theme Name: Learning
    Author: malik ateeq
    Author URI: https://www.facebook.com/malickateeq
    Version: 1.0
    */
```

## Wordpress functions
0. Functions related to site info
```php
    // use bloginfo('') function and pass a key variable to get its values like;
    bloginfo('charset');    // site charset
    bloginfo('name');    // name of the site
    bloginfo('description');    // site description
    home_url(); // to get home url :D

```

1. Functions related to POSTS
```php
    // To get Title of a post, or any custom post
    the_title();

    // And also have a function for content
    the_content();

    // URL to that post
    the_permalink();
```

## Wordpress navigation menu
```php
    // List all different Pages
    wp_nav_menu();

    // To create (then get) different nav items
    $args = array('theme_location'=>'primary'); // or theme_location =>footer for footer nav
    wp_nav_menu($args);

    // Now, Regiseter above menu locations in functions.php
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'footer' => __('Footer Menu'),
    ));

    // Now control above categories from admin panel under
    Appreance > Menus
    1. Create Menus: 'Primary Menu Links' and  'Footer Menu Links'
    2. Add pages whichever you want
    3. Set references in "Manage Locations" tab.

```

## Wordpress Header & Footer
```php
    // use below function to get header and footer 
    get_header();
    get_footer();

    // It'll look for a file name header.php and footer.php
    // create above files to override default.
```
- 'header.php' file
```php
    // Open html, doctype in header.php and close it in footer.php
    // place below function within header and footer; for plugin etc.
    wp_head();
    wp_footer();

    // And add body class in order to target different body classes
    body_class();
```

## Wordpress stylesheets/scripts etc.
- Fist way is to include them in header and the second way is include them it functions.php
- functions.php handles lots of things
```php
    // In 'functions.php' add function to install css
    function site_resources(){  // any function
        wp_enqueue_style('style', get_stylesheet_uri() );
    }

    // Run above function
    add_action('wp_enqueue_scripts', 'site_resources');
```

## Wordpress Pages Customization
- make a new page 'page.php' <!-- It'll define page template for page -->
```php

```
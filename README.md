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

    // Time
    the_time('m/d/y');  // 'F j, Y g:i a'

    // The Author
    the_author();   // Author name who posted it

    // Url of Author posts
    get_author_posts_url( get_the_author_meta('ID') );  // Get author ID: get_the_author_meta('ID');

    // Categories
    $categories = get_the_category();   // get all categories in which a post is belongs to
    $separator = ', ';
    $output = '';
    if($categories){
        foreach($categories as $category){
            $output .= '<a href=" '. get_category_link($category->term_id) .' ">'. $category->cat_name . '</a>' . $separator;
        }
        echo $output;
    }
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
    // To check for current page
    if( is_page($page_id_here) );  // you can also pass 'slug_name' here
    // To check page_id except for URL goto
    // Pages > Click-on-the-page > : here you'll see post=some_id
    // Or we can also use Slug name instead of page_ids

    // Got to Settings > Permalinks > Here select how do you want to include in your URL's
```

- To Make a template for a specific page
    * Just make a new page and name it lik: page-page_slug_namge or page-page_id then you have it.

- To make a Template and use/assign it from admin panel.
```php
    1. Make a page with any name lets say 'special-template.php'
    2. Now in 'special-template.php' add below comment.
    /*
        Template Name: Special Layout
    */
        Your custom code for that template goes here..

    3. It will register 'Special Layout' and you can use it in Admin panel to assign to pages.
```

- Child Pages
```php
    // assign child-aprent pages from the admin panel

    wp_list_pages();    // will list all pages-subpages of the site.

    // List only subpages to a Parent Page
    $args = array(
        'child_of' => $post->ID;    // current page id
        'title_li' => '',       // Title of bullets is set NULL/Empty
    );

    // Make a function if we want to list ancester(or siblings) pages in a child page
    $args = array(
        'child_of' => get_top_ancestor_id(),    // define its functions in functions.php
        'title_li' => '',
    );
    // then
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
    }

    wp_list_pages($args);

    // Access post outside just use 
    global $post;
```

## Wordpress Post Archives (Category, Author)
```php
    // Show author, category info on top of a only category view page

    // Make a new file name archive.php
    // Place your logic here for specific posts
    if( is_category() ){
        single_cat_title();
    }else if( is_tag() ){
        single_tag_title();
    }else if( is_author() ){
        echo 'Author Archives: '.get_the_author();
    }else if( is_day() ){
        echo 'Daily Archives: '.get_the_date();
    }else if( is_month() ){
        echo 'Monthly Archives: '.get_the_date('F Y');
    }else if( is_year() ){
        echo 'Yearly Archives: '.get_the_date('Y');
    }else{
        echo 'Archive';
    }

    // show piece of your posts's text
    the_excerpt();
```
<?php
// Header
get_header();
    ?>
        <h2>Search results for: <?php the_search_query(); ?> </h2>
    <?php
    if( have_posts() )
    {
        while( have_posts() )
        {
            the_post(); 
            get_template_part('content'); 
        }
    
    }
    else
    {
        echo 'No content found!';
    }

// Footer
get_footer();
?>
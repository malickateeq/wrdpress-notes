<?php
// Header
get_header();

    if( have_posts() )
    {
        while( have_posts() )
        {
            the_post(); 

            // Code snippet from 'content.php'
            get_template_part('content', get_post_format()); 
        }
    }
    else
    {
        echo 'No content found!';
    }

    echo paginate_links();
    
    dynamic_sidebar('sidebar1');

// Footer
get_footer();
?>
<?php
// Header
get_header();

    if( have_posts() )
    {
        while( have_posts() )
        {
            the_post(); 
            ?>
            <h1> My homepage..... </h1>
            <?php
            // Code snippet from 'content.php'
            get_template_part('content', get_post_format()); 
        }
    }
    else
    {
        echo 'No content found!';
    }
    

// Footer
get_footer();
?>
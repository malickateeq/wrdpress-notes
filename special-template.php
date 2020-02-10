<?php

/* 
    Template Name: Special Layout
*/

// Header
get_header();

    if( have_posts() )
    {
        while( have_posts() )
        {
            the_post(); ?>

            <article class="post page">
                <h2 style="color:grey; font-size:120px;"> <?php the_title(); ?> ; </h2>
                <?php the_content(); ?>
            </article>

        <?php
        }
    
    }
    else
    {
        echo 'No content found!';
    }

// Footer
get_footer();
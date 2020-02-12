<?php
// Header
get_header();

    if( have_posts() )
    {
        while( have_posts() )
        {
            the_post(); ?>

            <article class="post page">
                <h2 style="color:green;"> <?php the_title() ?> </h2>
                <?php the_content(); ?>

                <!-- container to inject posts on -->
                <div id="portfolio-posts-container"></div> 
                <button id="portfolio-posts-btn">Load more posts</button>

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
?>
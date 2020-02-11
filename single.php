<?php
// Header
get_header();

    if( have_posts() )
    {
        while( have_posts() )
        {
            the_post(); ?>

            <article class="post page">
                <!-- Child's Parent page: -->
                <span class="parent-link"> 
                </span>
                <!-- Show Child Pages -->
                <?php
                    $args = array(
                        'child_of' => get_top_ancestor_id(),
                        'title_li' => '',       // Title of bullets is set NULL/Empty
                    );
                    wp_list_pages($args);
                ?>
                <h2> <?php the_title() ?> </h2>

                <?php the_post_thumbnail('banner-image'); ?>
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
?>
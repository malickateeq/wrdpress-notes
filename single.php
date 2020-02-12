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

                <!-- About Author -->
                <div class="about-author clearfix">
                    <div class="about-author-image">
                        <?php echo get_avatar( get_the_author_meta('ID'), 512 ); ?>
                        <p> <?php echo get_the_author_meta('nickname') ?> </p>
                    </div>

                    <?php $otherPosts = new WP_Query(array(
                        'author' => get_the_author_meta('ID'),
                        'posts_per_page' => 3,
                        'post__not_in' => array( get_the_ID() ),
                    ));?>

                    <div class="about-author-text">
                        <h3> About the author: </h3>
                        <p> <?php echo get_the_author_meta('description') ?> </p>

                        <?php if( count_user_posts(get_the_author_meta('ID')) ) { ?>
                        <h4>Other postss by: <?php echo get_the_author_meta('nickname'); ?> </h4>
                        <ul>
                            <?php while($otherPosts->have_posts()){ $otherPosts->the_post(); ?>
                                <li> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </li>
                            <?php } wp_reset_postdata(); ?>
                        </ul>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"> 
                            View all posts by <?php echo get_the_author_meta('nickname'); ?></a>
                        
                        <?php } ?>
                    </div>
                </div>


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
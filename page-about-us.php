<?php
// Header
get_header();

    if( have_posts() )
    {
        while( have_posts() )
        {
            the_post(); ?>

            <article class="post page">

                <h2> <?php the_title() ?> </h2>

                <?php the_content(); ?>
            </article>

            <h4> Blog Posts About Us </h4>
            <?php
                $aboutPosts = new WP_Query(array(
                    'category_name' => 'about',
                    'posts_per_page' => 3,
                    // 'paged' => 2,    // means /page/2,3,4 etc.
                ));
                if( $aboutPosts->have_posts() )
                {
                    while( $aboutPosts->have_posts() )
                    {
                        $aboutPosts->the_post(); ?>

                            <li><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></li>

                        <?php
                    }
                }
            ?>
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
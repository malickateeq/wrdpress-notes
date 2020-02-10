<?php
// Header
get_header();


    if( have_posts() )
    {
        ?>
            <h2><?php 
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
            ?></h2>
        <?php
        while( have_posts() )
        {
            the_post(); ?>

            <article class="post">
                <h2> <a href="<?php the_permalink(); ?>"> <?php the_title() ?> </a> </h2>
                
                <p class="post-info"><?php 
                    the_time('F j, Y g:i a'); ?> 
                    
                    | by <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"> <?php the_author(); ?> </a> 
                    
                    | Posted in: <?php 
                        $categories = get_the_category();   // get all categories in which a post is belongs to
                        $separator = ', ';
                        $output = '';
                        if($categories){
                            foreach($categories as $category){
                                $output .= '<a href=" '. get_category_link($category->term_id) .' ">'. $category->cat_name . '</a>' . $separator;
                            }
                            echo trim($output, $separator); // will remove last ,
                        }
                ?></p>

                <?php the_excerpt(); ?>
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
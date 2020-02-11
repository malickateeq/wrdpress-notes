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
<?php
// Header
get_header();

    ?>
        <?php if(current_user_can('administrator')) { ?>
        <div class="admin-quick-add">
            <h3>Quich Add Post:</h3>
            <input type="text" name="title" placeholder="Title">
            <textarea name="content" id="content" placeholder="Content" cols="30" rows="3"></textarea>
            <button id="quick-add-btn">Create Post</button>
        </div>
        <?php } ?>

    <?php
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
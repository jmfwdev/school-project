<?php
get_header();
?>

<div class="student-taxonomy">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
            <div class="student">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="student-image">
                    <?php the_post_thumbnail(array(200, 300)); ?>
                </div>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>
    <?php
        endwhile;
    else :
        echo '<p>No students found</p>';
    endif;
    ?>
</div>

<?php
get_footer();
?>
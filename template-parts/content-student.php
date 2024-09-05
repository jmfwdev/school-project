<?php

/**
 * Template part for displaying students
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

// Change excerpt length to 25 words
add_filter('excerpt_length', function ($length) {
	return 25;
});

// Change excerpt ending to clickable text
add_filter('excerpt_more', function ($more) {
	return ' <a href="' . get_permalink() . '">' . __('Read More about the Student', 'school-theme') . '</a>';
});

// Query all students in alphabetical order by first name
$students = new WP_Query(array(
	'post_type' => 'student',
	'orderby' => 'meta_value',
	'meta_key' => 'first_name',
	'order' => 'ASC',
	'posts_per_page' => -1,
));

// Loop through students
if ($students->have_posts()) {
	while ($students->have_posts()) {
		$students->the_post();

		// Get student's taxonomy terms
		$taxonomy_terms = get_the_term_list(get_the_ID(), 'taxonomy_name', '', ', ');

		// Display student information
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header><!-- .entry-header -->

			<?php school_theme_post_thumbnail(); ?>

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

			<div class="taxonomy-terms">
				<?php echo $taxonomy_terms; ?>
			</div><!-- .taxonomy-terms -->

			<footer class="entry-footer">
				<?php school_theme_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-<?php the_ID(); ?> -->
<?php
	}
}

// Reset post data
wp_reset_postdata();

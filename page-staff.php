<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php

	$args = array(
		'post_type'      => 'fwd-staff',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'fwd-roles',
				'field'    => 'slug',
				'terms'    => 'Faculty',
				'Administrative'
			),
		),
	);

	$query = new WP_Query($args);


	?>

	<?php if ($query->have_posts()) : ?>

	<?php
		/*
			* Include the Post-Type-specific template for the content.
			* If you want to override this in a child theme, then include a file
			* called content-___.php (where ___ is the Post Type name) and that will be used instead.
			*/
		get_template_part('template-parts/content', 'fwd-staff');


		the_posts_navigation();

	endif;
	?>
</main>
<?php
get_footer();

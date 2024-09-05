<?php

/**
 * The template for displaying the Work Archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<header class="page-header">
		<?php
		the_archive_title('<h1 class="page-title">', '</h1>');
		the_archive_description('<div class="archive-description">', '</div>');
		?>
	</header><!-- .page-header -->
	<?php
	$args = array(
		'post_type'      => 'student',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'student-category',
				'field'    => 'slug',
				'terms'    => 'web'
			)
		)
	);

	$query = new WP_Query($args);
	if ($query->have_posts()) {
		echo '<section class="students-section" ><h2>Web</h2>';
		while ($query->have_posts()) {
			$query->the_post();
	?>
			<article class="work-item">
				<a href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
					<?php the_post_thumbnail('large'); ?>
				</a>
				<?php the_excerpt(); ?>
			</article>
	<?php
		}
		wp_reset_postdata();
		echo '</section>';
	}
	?>

	<?php
	$args = array(
		'post_type'      => 'student',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'fwd-work-category',
				'field'    => 'slug',
				'terms'    => 'photo'
			)
		)
	);
	$query = new WP_Query($args);
	if ($query->have_posts()) {
		echo '<section class="photo-section" ><h2>Photo</h2>';
		while ($query->have_posts()) {
			$query->the_post();
	?>
			<article class="photo-item">
				<a href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
					<?php the_post_thumbnail('large'); ?>
				</a>
				<?php the_excerpt(); ?>
			</article>
	<?php
		}
		wp_reset_postdata();
		echo '</section>';
	}
	?>


</main><!-- #primary -->

<?php
// get_sidebar();
get_footer();

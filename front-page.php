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
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page'); ?>

		<section class="home-blog">
			<h2><?php esc_html_e('Recent News', 'fwd') ?></h2>
			<?php

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 3,
			);

			$blog_query = new WP_Query($args);

			if ($blog_query->have_posts()) {
				echo "<div class='latest-blog'>";
				while ($blog_query->have_posts()) {
					$blog_query->the_post();
			?>
					<article>
						<a href="	
						<?php
						the_permalink();
						?>
					">
							<?php
							the_post_thumbnail('landscape-blog');
							?>
							<h3>
								<?php
								the_title();
								?>
							</h3>
							<p>
								READ MORE ->
							</p>
						</a>
					</article>
			<?php
				}
				echo "</div>";
				wp_reset_postdata();
			}
			?>
		</section>

	<?php
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php

get_footer();

<?php
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content', 'student');
			}
		} else {
			get_template_part('template-parts/content', 'none');
		}
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>
<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		//content
		$args_administrative = array(
			'post_type'      => 'fwd-staff',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'fwd-roles',
					'field'    => 'slug',
					'terms'    => 'Administrative',
				),
			),
		);
		
		$args_faculty = array(
			'post_type'      => 'fwd-staff',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'fwd-roles',
					'field'    => 'slug',
					'terms'    => 'Faculty',
				),
			),
		);
		
		$query_administrative = new WP_Query( $args_administrative );
		$query_faculty = new WP_Query( $args_faculty );
		
		if ( $query_administrative->have_posts() ) : ?>
			<section>
				<h2><?php esc_html_e( 'Administrative', 'school-theme' ); ?></h2>
				<div class='tax-div'>
					<?php
					while ( $query_administrative->have_posts() ) :
						$query_administrative->the_post(); ?>
						<article>
							<h2><?php the_title(); ?></h2>
							<p>
							<?php 
								if ( function_exists( 'get_field' ) ) {
									$biography = get_field( 'staff_biography' );
									if ( $biography ) {
										echo esc_html( $biography );
									}
								}
							?>
							</p>
						</article>
						<?php
					endwhile;
					echo "</div>";
					wp_reset_postdata();
					?>
			</section>
		<?php endif; ?>
		
		<?php if ( $query_faculty->have_posts() ) : ?>
			<section>
				<h2><?php esc_html_e( 'Faculty', 'school-theme' ); ?></h2>
				<div class='tax-div'>
					<?php
					while ( $query_faculty->have_posts() ) :
						$query_faculty->the_post(); ?>
						<article>
							<h2><?php the_title(); ?></h2>
							<p>
							<?php 
								if ( function_exists( 'get_field' ) ) {
									$biography = get_field( 'staff_biography' );
									if ( $biography ) {
										echo esc_html( $biography );
									}
								}
							?>
							</p>
							<p>
								<?php
								if ( function_exists( 'get_field' ) ) {
									$url = get_field( 'staff_website' );
									if ( !empty($url) ) {
								?>
									<a href="<?php echo esc_url($url); ?>">Instructor Website</a>
								<?php
									}
								}
								?>
							</p>
						</article>
						<?php
					endwhile;
					echo "</div>";
					wp_reset_postdata();
					?>
			</section>
		<?php endif;
		

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				school_theme_posted_on();
				school_theme_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php school_theme_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'school-theme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'school-theme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php school_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

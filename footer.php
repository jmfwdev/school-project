<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Theme
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-credits">
		<h2>CREDITS</h2>
		<p>Created by:
			<a href="https://marcsapa.com/">Marc Sapa</a>
			&
			<a href="#">JM Hore</a>
		</p>
		<p>
			Inspiration from <a href="">SFU School Website</a>
		</p>
	</div>
	<nav id="footer-navigation" class="footer-navigation">
		<h2>LINKS</h2>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'menu-id' => 'footer-menu',
			)
		);
		?>
	</nav>
	<div class="site-info">
		<a href="<?php echo esc_url(__('https://wordpress.org/', 'school-theme')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'school-theme'), 'WordPress');
			?>
		</a>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
<?php

/**
 * Template Name: Home Page
 */
add_filter('get_the_archive_title_prefix', '__return_empty_string');
get_header();
?>
<main id="primary" class="site-main">
	<header>
		<h1 id="news-title" class="page-title">News</h1>
	</header>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up" data-aos-duration="1000">
				<header class="entry-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="entry-meta">
						<span class="posted-on">Posted on <a href="<?php the_permalink(); ?>" rel="bookmark">
								<time class="entry-date published updated" datetime="<?php echo get_the_date('c'); ?>">
									<?php echo get_the_date(); ?>
								</time>
							</a></span>
						<span class="byline"> by <span class="author vcard">
								<a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
									<?php the_author(); ?>
								</a>
							</span></span>
					</div>
				</header>
				<?php if (has_post_thumbnail()) : ?>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php the_post_thumbnail('full', array('class' => 'attachment-post-thumbnail size-post-thumbnail wp-post-image', 'loading' => 'lazy')); ?>
					</a>
				<?php endif; ?>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
				<footer class="entry-footer" data-aos="fade-up" data-aos-delay="900">
					<span class="cat-links">Posted in <?php the_category(', '); ?></span>
					<span class="tags-links"><?php the_tags('Tagged ', ', '); ?></span>
					<span class="comments-link">
						<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
					</span>
				</footer>
			</article>
		<?php endwhile; ?>
		<div class="pagination">
			<?php
			the_posts_pagination(array(
				'prev_text' => __('Previous', 'your-theme'),
				'next_text' => __('Next', 'your-theme'),
			));
			?>
		</div>
	<?php else : ?>
		<?php get_template_part('template-parts/content', 'none'); ?>
	<?php endif; ?>
</main>
<?php
// get_sidebar();
get_footer();
?>
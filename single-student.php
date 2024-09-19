<?php
get_header();
?>

<div class="single-student">
	<div class="content-wrap-single-student">

		<h1><?php the_title(); ?></h1>
		<div class="student-image">
			<?php the_post_thumbnail('student-thumbnail'); ?>
		</div>
		<div class="student-content">
			<?php the_content(); ?>
		</div>
	</div>

	<div class="related-students">
		<h2>Related Students</h2>
		<?php
		$terms = get_the_terms(get_the_ID(), 'student_category');
		if ($terms) {
			$term_ids = wp_list_pluck($terms, 'term_id');

			$related_students = new WP_Query(array(
				'post_type'      => 'student',
				'tax_query'      => array(
					array(
						'taxonomy' => 'student_category',
						'field'    => 'term_id',
						'terms'    => $term_ids,
					),
				),
				'post__not_in'   => array(get_the_ID()),
			));

			if ($related_students->have_posts()) :
				while ($related_students->have_posts()) : $related_students->the_post();
		?>
					<div class="related-student">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
		<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p>No related students found</p>';
			endif;
		}
		?>
	</div>
</div>

<?php
get_footer();
?>
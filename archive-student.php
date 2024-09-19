<?php
get_header();
?>

<div class="student-list">
	<?php
	$args = array(
		'post_type'      => 'student',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);
	$students = new WP_Query($args);

	if ($students->have_posts()) :
		while ($students->have_posts()) : $students->the_post();
	?>
			<div class="student">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="student-image">
					<?php the_post_thumbnail('student-featured'); ?>
				</div>
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
				<div class="taxonomy">
					<?php echo get_the_term_list(get_the_ID(), 'student_category', 'Specialty: ', ', '); ?>
				</div>
			</div>
	<?php
		endwhile;
	else :
		echo '<p>No students found</p>';
	endif;

	wp_reset_postdata();
	?>
</div>

<?php
get_footer();
?>
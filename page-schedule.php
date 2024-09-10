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

		get_template_part('template-parts/content', 'page');


		if (function_exists('get_field')) {
			$course_schedule = get_field('course_schedule');


			if ($course_schedule) {

				foreach ($course_schedule as $schedule_item) {

					$schedule_date = $schedule_item['date'];
					$schedule_course = $schedule_item['course'];
					$schedule_instructor = $schedule_item['instructors'];

					echo '<table class="schedule-table">';
					echo '<thead>';


					echo '<tr>';
					echo '<td>' . $schedule_course . '</td>';
					echo '<td>' . $schedule_date . '</td>';
					echo '<td>' . $schedule_instructor . '</td>';
					echo '</tr>';


					echo '</thead>';
					echo '</tbody>';
					echo '</table>';
				}
			}
		}



	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();

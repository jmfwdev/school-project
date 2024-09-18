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

	?>

				<table class="schedule-table">
					<caption>Weekly Course Schedule</caption>
					<thead>
						<tr>
							<th>Date</th>
							<th>Course</th>
							<th>Instructor</th>
						</tr>
					</thead>

					<tbody>

						<?php

						foreach ($course_schedule as $schedule_item) {

							$schedule_date = $schedule_item['date'];
							$schedule_course = $schedule_item['course'];
							$schedule_instructor = $schedule_item['instructors'];

							echo '<tr>';
							echo '<td>';
							echo $schedule_date;
							echo '</td>';

							echo '<td>';
							echo $schedule_course;
							echo '</td>';

							echo '<td>';
							echo $schedule_instructor;
							echo '</td>';
							echo '</tr>';

						?>


						<?php
						}
						?>
					</tbody>

				</table>
	<?php
			}
		}



	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();

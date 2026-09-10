<?php
/**
 *
 * Pagination Functions
 *
 * @package CommExpress
 */

if (!function_exists('comm_express_archive_pagination_x')):

	// Archive Page Navigation
	function comm_express_archive_pagination_x()
	{

		the_posts_pagination();
	}

endif;
add_action('comm_express_archive_pagination', 'comm_express_archive_pagination_x', 20);
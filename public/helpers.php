<?php

/**
 * Constants of user
 */

if (!function_exists('comment_time')) {

	function comment_time($created_at)
	{
		return date('Y-m-D h:i A',strtotime($created_at));
	}
}
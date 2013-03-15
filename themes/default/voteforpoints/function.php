<?php

if (!function_exists("getTimeLeft"))
{
	function getTimeLeft($ts)
	{
		$timestamp = new DateTime($ts);
		$now  = new DateTime("Now");

		$interval = $timestamp->diff($now);
		return $interval->format('%R%a days');
	}
}

?>
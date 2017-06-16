<?php namespace Revel;

class Utils {

	/**
	 * Extract an ID from an API URL. The ID must be at the tail end of the URL with an optional forward slash following
	 * it.
	 *
	 * @param string|int $from The input to attempt to extract an ID from.
	 *
	 * @return int
	 */
	public static function extractId($from) {
		if (is_int($from)) return $from;

		preg_match('/(\d+)\/?$/', $from, $matches);
		return empty($matches) ? null : intval($matches[1]);
	}

}
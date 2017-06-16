<?php namespace Revel\Api;

use Revel\Models\Establishment;

/**
 * API wrapper that deals with {@link Establishment establishments}.
 *
 * @author Marty Wallace
 */
class Establishments extends Api {

	/**
	 * Get all {@link Establishment establishments}.
	 *
	 * @return Establishment[]
	 */
	public function all() {
		return $this->cache('all', Establishment::many($this->call('GET', '/enterprise/Establishment?limit=1000')->objects()));
	}

	/**
	 * Find one establishment using its ID.
	 *
	 * @param int $id The establishment ID.
	 *
	 * @return Establishment
	 */
	public function findById($id) {
		foreach ($this->all() as $establishment) {
			if ($establishment->id === $id) {
				return $establishment;
			}
		}

		return null;
	}

}
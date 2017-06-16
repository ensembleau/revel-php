<?php namespace Revel\Api;

use Revel\Models\Establishment;
use Revel\Utils;

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
		return $this->cache('all', Establishment::many($this->revel, $this->get('/enterprise/Establishment?limit=1000')->objects()));
	}

	/**
	 * Find one establishment using its ID.
	 *
	 * @param int|string $id The establishment ID or resource URL.
	 *
	 * @return Establishment
	 */
	public function findById($id) {
		$id = Utils::extractId($id);

		return $this->cache('findById' . $id, Establishment::one($this->revel, $this->get('/enterprise/Establishment/' . $id)->data()));
	}

}
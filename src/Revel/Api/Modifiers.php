<?php namespace Revel\Api;

use Revel\Utils;
use Revel\Models\Modifier;

class Modifiers extends Api {

	/**
	 * @return Modifier[]
	 */
	public function all() {
		return $this->cache('all', function() {
			return Modifier::many($this->revel, $this->get('/resources/Modifier?limit=1000')->objects());
		});
	}

	/**
	 * @param int $id
	 *
	 * @return Modifier
	 */
	public function findById($id) {
		$id = Utils::extractId($id);

		return $this->cache('findById' . $id, function() {
			foreach ($this->all() as $modifier) {
				if ($modifier->id === $id) return $modifier;
			}

			return null;
		});
	}

}
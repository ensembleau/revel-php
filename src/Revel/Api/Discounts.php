<?php namespace Revel\Api;

use Revel\Models\Discount;
use Revel\Utils;

class Discounts extends Api {

	/**
	 * @return Discount[]
	 */
	public function all() {
		return $this->cache('all', function() {
			return Discount::many($this->revel, $this->get('/resources/Discount?limit=1000')->objects());
		});
	}

	/**
	 * Get one discount using its ID.
	 *
	 * @param int $id The discount ID.
	 *
	 * @return Discount
	 */
	public function findById($id) {
		$id = Utils::extractId($id);

		return $this->cache('findById' . $id, function() use ($id) {
			foreach ($this->all() as $discount) {
				if ($discount->id === $id) return $discount;
			}

			return null;
		});
	}

}
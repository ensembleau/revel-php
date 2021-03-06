<?php namespace Revel\Api;

use Revel\Models\Category;
use Revel\Utils;

class Categories extends Api {

	/**
	 * @return Category[]
	 */
	public function all() {
		return $this->cache('all', function() {
			return Category::many($this->revel, $this->get('/products/ProductCategory?limit=1000')->objects());
		});
	}

	/**
	 * Get one category using its ID.
	 *
	 * @param int $id The category ID.
	 *
	 * @return Category
	 */
	public function findById($id) {
		$id = Utils::extractId($id);

		return $this->cache('findById' . $id, function() use ($id) {
			foreach ($this->all() as $category) {
				if ($category->id === $id) return $category;
			}

			return null;
		});
	}

}
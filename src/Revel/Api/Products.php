<?php namespace Revel\Api;

use Revel\Models\Product;

class Products extends Api {

	/**
	 * Get all {@link Product products}.
	 *
	 * @return Product[]
	 */
	public function all() {
		return $this->cache('all', Product::many($this->call('GET', '/resources/Product?limit=1000')));
	}

}
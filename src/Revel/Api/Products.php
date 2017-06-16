<?php namespace Revel\Api;

use Revel\Utils;
use Revel\Models\Product;

class Products extends Api {

	/**
	 * Get all {@link Product products}.
	 *
	 * @return Product[]
	 */
	public function all() {
		return $this->cache('all', Product::many($this->revel, $this->get('/resources/Product?limit=1000')->objects()));
	}

	/**
	 * Get a single product.
	 *
	 * @param int|string The product ID or resource URL.
	 *
	 * @return Product
	 */
	public function findById($id) {
		$id = Utils::extractId($id);

		return $this->cache('findById' . $id, Product::one($this->revel, $this->get('/resources/Product/' . $id)->data()));
	}

}
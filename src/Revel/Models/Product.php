<?php namespace Revel\Models;

/**
 * A product.
 *
 * @property-read int $id
 * @property-read string $name
 *
 * @author Marty Wallace
 */
class Product extends Model {

	protected function fields() {
		return [
			'id' => 'id',
			'name' => 'name',
		];
	}

}
<?php namespace Revel\Models;

use Revel\Utils;

/**
 * A product.
 *
 * @property-read int $id
 * @property-read string $uuid
 * @property-read string $name
 * @property-read string $barcode
 * @property-read int $establishmentId
 * @property-read int $categoryId
 * @property-read bool $available
 *
 * @author Marty Wallace
 */
class Product extends Model {

	protected function fields() {
		return [
			'id' => $this->raw('id'),
			'uuid' => $this->raw('uuid'),
			'name' => $this->raw('name'),
			'barcode' => $this->raw('barcode'),
			'establishmentId' => Utils::extractId($this->raw('establishment')),
			'categoryId' => Utils::extractId($this->raw('category')),
			'available' => $this->raw('available')
		];
	}

	/**
	 * @return Establishment
	 */
	public function establishment() {
		return $this->revel->establishments()->findById($this->establishmentId);
	}

	/**
	 * @return Category
	 */
	public function category() {
		return $this->revel->categories()->findById($this->categoryId);
	}

}
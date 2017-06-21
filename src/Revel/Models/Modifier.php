<?php namespace Revel\Models;

use Revel\Models\Contracts\BelongsToEstablishment;
use Revel\Utils;

/**
 * @property-read int $id
 * @property-read bool $active
 * @property-read int $establishmentId
 * @property-read string $name
 * @property-read string $uuid
 * @property-read string $barcode
 * @property-read string $description
 * @property-read float $price
 */
class Modifier extends Model implements BelongsToEstablishment {

	protected function fields() {
		return [
			'id' => $this->raw('id'),
			'active' => $this->raw('active', false),
			'establishmentId' => Utils::extractId($this->raw('establishment')),
			'name' => $this->raw('name'),
			'uuid' => $this->raw('uuid'),
			'barcode' => $this->raw('barcode'),
			'description' => $this->raw('description'),
			'price' => $this->raw('price')
		];
	}

	/**
	 * @return Establishment
	 */
	public function establishment() {
		return $this->revel->establishments()->findById($this->establishmentId);
	}

}
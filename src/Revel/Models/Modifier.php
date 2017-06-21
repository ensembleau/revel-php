<?php namespace Revel\Models;

use Revel\Models\Contracts\BelongsToEstablishment;
use Revel\Models\Contracts\Sendable;
use Revel\Utils;

/**
 * @property int $id
 * @property bool $active
 * @property int $establishmentId
 * @property string $name
 * @property string $uuid
 * @property string $barcode
 * @property string $description
 * @property float $price
 */
class Modifier extends Model implements Sendable, BelongsToEstablishment {

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

	public function bundle() {
		return [];
	}

	/**
	 * @return Establishment
	 */
	public function establishment() {
		return $this->revel->establishments()->findById($this->establishmentId);
	}

}
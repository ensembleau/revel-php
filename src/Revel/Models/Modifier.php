<?php namespace Revel\Models;

use Revel\Models\Contracts\BelongsToEstablishment;
use Revel\Models\Contracts\Sendable;
use Revel\Utils;

class Modifier extends Model implements Sendable, BelongsToEstablishment {

	protected function fields() {
		return [
			'id' => $this->raw('id'),
			'active' => $this->raw('active', false),
			'establishmentId' => Utils::extractId($this->raw('establishment')),
			'name' => $this->raw('name'),
			'barcode' => $this->raw('barcode'),
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
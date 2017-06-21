<?php namespace Revel\Models;

use Revel\Models\Contracts\BelongsToEstablishment;
use Revel\Utils;

/**
 * @property-read int $id
 * @property-read bool $active
 * @property-read int $establishmentId
 * @property-read string $name
 * @property-read float $amount
 * @property-read int $applicationType
 * @property-read int $discountType
 * @property-read int $qualificationType
 * @property-read bool $autoApply
 */
class Discount extends Model implements BelongsToEstablishment {

	protected function fields() {
		return [
			'id' => $this->raw('id'),
			'active' => $this->raw('active', false),
			'establishmentId' => Utils::extractId($this->raw('establishment')),
			'name' => $this->raw('name'),
			'amount' => $this->raw('discount_amount', 0),
			'applicationType' => $this->raw('application_type'),
			'discountType' => $this->raw('discount_type'),
			'qualificationType' => $this->raw('qualification_type'),
			'autoApply' => $this->raw('auto_apply', false)
		];
	}

	/**
	 * @return Establishment
	 */
	public function establishment() {
		return $this->revel->establishments()->findById($this->establishmentId);
	}

}
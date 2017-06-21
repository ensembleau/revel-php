<?php namespace Revel\Models;

/**
 * @property-read int $id
 * @property-read bool $active
 * @property-read string $name
 * @property-read float $amount
 * @property-read int $applicationType
 * @property-read int $discountType
 * @property-read int $qualificationType
 * @property-read bool $autoApply
 */
class Discount extends Model {

	protected function fields() {
		return [
			'id' => $this->raw('id'),
			'active' => $this->raw('active', false),
			'name' => $this->raw('name'),
			'amount' => $this->raw('discount_amount', 0),
			'applicationType' => $this->raw('application_type'),
			'discountType' => $this->raw('discount_type'),
			'qualificationType' => $this->raw('qualification_type'),
			'autoApply' => $this->raw('auto_apply', false)
		];
	}

}
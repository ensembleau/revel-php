<?php namespace Revel\Models;

use Revel\Models\Contracts\Sendable;

/**
 * @property int $modifierId
 * @property int $quantity
 * @property float $price
 */
class OrderItemModifier extends Model implements Sendable {

	protected function fields() {
		return [
			'modifierId' => $this->raw('modifierId'),
			'quantity' => $this->raw('quantity', 1),
			'price' => $this->raw('price', 1)
		];
	}

	public function bundle() {
		return array_filter([
			'modifier' => $this->modifierId,
			'qty' => $this->quantity,
			'price' => $this->price
		], function($value) {
			return $value !== null;
		});
	}

}
<?php namespace Revel\Models;

use Revel\Models\Contracts\Sendable;

/**
 * @property int $price
 * @property int $productId
 * @property int $quantity
 * @property Modifier[] $modifiers
 */
class OrderItem extends Model implements Sendable {

	protected function fields() {
		return [
			'price' => $this->raw('price', 0),
			'productId' => $this->raw('productId', null),
			'quantity' => $this->raw('quantity', 1),
			'modifiers' => $this->raw('modifiers', null)
		];
	}

	public function bundle() {
		return array_filter([
			'price' => floatval($this->price),
			'product' => intval($this->productId),
			'quantity' => intval($this->quantity),
			'modifieritems' => empty($this->modifiers) ? null : array_map(function(OrderItemModifier $modifier) {
				return $modifier->bundle();
			}, $this->modifiers)
		], function($value) {
			return $value !== null;
		});
	}

}
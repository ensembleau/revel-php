<?php namespace Revel\Models;

use Revel\Models\Contracts\Sendable;

/**
 * @property string $skin
 * @property int $establishmentId
 * @property mixed[] $items
 * @property-read OrderInfo $orderInfo
 * @property-read PaymentInfo $paymentInfo
 *
 * @see OrderInfo
 * @see PaymentInfo
 * @see OrderItem
 */
class Order extends Model implements Sendable {

	protected function fields() {
		return [
			'skin' => $this->raw('skin', 'weborder'),
			'establishmentId' => $this->raw('establishmentId', null),
			'items' => $this->raw('items', []),
			'orderInfo' => $this->raw('orderInfo', null),
			'paymentInfo' => $this->raw('paymentInfo', null)
		];
	}

	public function bundle() {
		return array_filter([
			'skin' => $this->skin,
			'establishment' => $this->establishmentId,
			'items' => array_map(function(OrderItem $item) { return $item->bundle(); }, $this->items),
			'orderInfo' => empty($this->orderInfo) ? null : $this->orderInfo->bundle(),
			'paymentInfo' => empty($this->paymentInfo) ? null : $this->paymentInfo->bundle()
		], function($value) {
			return $value !== null;
		});
	}

}
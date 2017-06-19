<?php namespace Revel\Models;

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
class Order extends SendableModel {

	protected function fields() {
		return [
			'skin' => $this->raw('skin', 'weborder'),
			'establishmentId' => $this->raw('establishmentId', null),
			'items' => $this->raw('items', []),
			'orderInfo' => $this->raw('orderInfo', OrderInfo::one($this->revel)),
			'paymentInfo' => $this->raw('paymentInfo', PaymentInfo::one($this->revel))
		];
	}

	public function bundle() {
		return [
			'skin' => $this->skin,
			'establishment' => $this->establishmentId,
			'items' => array_map(function(OrderItem $item) { return $item->bundle(); }, $this->items),
			'orderInfo' => $this->orderInfo->bundle(),
			'paymentInfo' => $this->paymentInfo->bundle()
		];
	}

}
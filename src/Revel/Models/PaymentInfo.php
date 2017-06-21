<?php namespace Revel\Models;

use Revel\Models\Contracts\Sendable;

/**
 * @property string|int $transactionId
 * @property int $amount
 * @property int $tip
 * @property int $type
 */
class PaymentInfo extends Model implements Sendable {

	protected function fields() {
		return [
			'transactionId' => $this->raw('transactionId', null),
			'amount' => $this->raw('amount', 0),
			'tip' => $this->raw('tip', 0),
			'type' => $this->raw('type', 7)
		];
	}

	public function bundle() {
		return [
			'transaction_id' => $this->transactionId,
			'amount' => floatval($this->amount),
			'tip' => $this->tip,
			'type' => $this->type
		];
	}

}
<?php namespace Revel\Models;

use DateTime;
use Revel\Enums\DiningOptions;

/**
 * @property DateTime $created
 * @property int $diningOption
 * @property bool $asap
 * @property-read Customer $customer
 *
 * @see DiningOptions
 * @see Customer
 */
class OrderInfo extends SendableModel {

	protected function fields() {
		return [
			'created' => $this->raw('created', new DateTime()),
			'diningOption' => $this->raw('diningOption', DiningOptions::ONLINE),
			'asap' => $this->raw('asap', false),
			'customer' => $this->raw('customer', Customer::one($this->revel))
		];
	}

	public function bundle() {
		return [
			'created_date' => $this->created->format('Y-m-d H:i:s'),
			'dining_option' => $this->diningOption,
			'asap' => $this->asap,
			'customer' => $this->customer->bundle()
		];
	}

}
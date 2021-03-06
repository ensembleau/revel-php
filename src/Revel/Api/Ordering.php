<?php namespace Revel\Api;

use Exception;
use Revel\Models\Order;
use Revel\Enums\ResponseStatus;

class Ordering extends Api {

	/**
	 * Submit an online order.
	 *
	 * @param Order $order The order to submit.
	 *
	 * @return int The order ID provided by Revel if the order was submitted successfully.
	 *
	 * @throws Exception If the API returns any errors.
	 */
	public function submit(Order $order) {
		$response = $this->post('/specialresources/cart/submit', $order->bundle())->data();

		if ($response->status === ResponseStatus::ERROR) {
			if (property_exists($response->error->details, 'message')) {
				throw new Exception($response->error->details->message);
			} else {
				throw new Exception($response->error->message);
			}
		} else if ($response->status === ResponseStatus::OK) {
			return $response->orderId;
		}

		return $response;
	}

}
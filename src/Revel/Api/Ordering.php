<?php namespace Revel\Api;

use Exception;
use Revel\Models\Order;

class Ordering extends Api {

	/**
	 * Submit an online order.
	 *
	 * @param Order $order The order to submit.
	 *
	 * @return mixed
	 *
	 * @throws Exception If the API returns any errors.
	 */
	public function submit(Order $order) {
		$response = $this->post('/specialresources/cart/submit', $order->bundle())->data();

		if ($response->status === 'ERROR') {
			if (property_exists($response->error->details, 'message')) {
				throw new Exception($response->error->details->message);
			} else {
				throw new Exception($response->error->message);
			}
		}

		return $response;
	}

}
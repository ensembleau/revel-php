<?php namespace Revel\Api;

use Revel\Models\Order;

class Ordering extends Api {

	/**
	 * Submit an online order.
	 *
	 * @param Order $order The order to submit.
	 */
	public function submit(Order $order) {
		print_r($this->post('/specialresources/cart/submit', $order->bundle()));
	}

}
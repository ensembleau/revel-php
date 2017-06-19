<?php

header('Content-Type: text/plain');

require(realpath(__DIR__ . '/../vendor/autoload.php'));

use Dotenv\Dotenv;
use Revel\Revel;
use Revel\Models\Order;
use Revel\Models\OrderItem;
use Revel\Models\PaymentInfo;
use Revel\Models\OrderInfo;
use Revel\Models\Customer;
use Revel\Models\Category;
use Revel\Models\Product;

$env = new Dotenv(realpath(__DIR__ . '/../'));
$env->load();

$revel = new Revel(getenv('domain'), getenv('secret'), getenv('key'));

$order = Order::one($revel, [
	'establishmentId' => 1,
	'items' => [
		OrderItem::one($revel, [
			'price' => 16,
			'productId' => 85
		])
	],
	'orderInfo' => OrderInfo::one($revel, [
		'customer' => Customer::one($revel, [
			'phone' => '0400000000',
			'email' => 'test@test.com'
		])
	]),
	'paymentInfo' => PaymentInfo::one($revel, [
		'amount' => 15
	])
]);

print_r(array_map(function(Product $product) {
	return $product->raw();
}, $revel->products()->all()));
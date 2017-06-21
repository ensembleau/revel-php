<?php

header('Content-Type: text/plain');

require(realpath(__DIR__ . '/../vendor/autoload.php'));

use Dotenv\Dotenv;
use Revel\Revel;
use Revel\Models\Order;
use Revel\Models\OrderItem;
use Revel\Models\OrderItemModifier;
use Revel\Models\PaymentInfo;
use Revel\Models\OrderInfo;
use Revel\Models\Customer;
use Revel\Models\Category;
use Revel\Models\Product;
use Revel\Models\Discount;
use Revel\Models\Modifier;

$env = new Dotenv(realpath(__DIR__ . '/../'));
$env->load();

$revel = new Revel(getenv('domain'), getenv('secret'), getenv('key'));

$order = Order::one($revel, []);
$order->items = [
	OrderItem::one($revel, [
		'productId' => 91,
		'price' => 15,
		'modifiers' => [
			OrderItemModifier::one($revel, [
				'modifierId' => 12
			])
		]
	])
];

print_r($order->bundle());

// print_r(array_map(function(Modifier $modifier) { return $modifier->data(); }, $revel->modifiers()->all()));
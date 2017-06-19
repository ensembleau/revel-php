<?php

header('Content-Type: text/plain');

require(realpath(__DIR__ . '/../vendor/autoload.php'));

use Dotenv\Dotenv;
use Revel\Revel;
use Revel\Models\Order;
use Revel\Models\OrderItem;

$env = new Dotenv(realpath(__DIR__ . '/../'));
$env->load();

$revel = new Revel(getenv('domain'), getenv('secret'), getenv('key'));


$order = Order::one($revel);

$order->items = [
	OrderItem::one($revel, [
		'price' => 1500,
		'productId' => 85,
		'quantity' => 2
	])
];

print_r($order->bundle());
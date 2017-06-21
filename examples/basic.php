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
use Revel\Models\Discount;

$env = new Dotenv(realpath(__DIR__ . '/../'));
$env->load();

$revel = new Revel(getenv('domain'), getenv('secret'), getenv('key'));

print_r(array_map(function(Discount $discount) { return $discount->data(); }, $revel->discounts()->all()));
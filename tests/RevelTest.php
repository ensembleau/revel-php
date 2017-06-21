<?php

require(realpath(__DIR__ . '/../vendor/autoload.php'));

use PHPUnit\Framework\TestCase;
use Revel\Revel;
use Revel\Models\Order;
use Revel\Models\OrderItem;
use Revel\Models\OrderItemModifier;
use Revel\Models\OrderInfo;
use Revel\Models\PaymentInfo;
use Dotenv\Dotenv;

try {
	(new Dotenv(realpath(__DIR__ .'/../')))->load();
} catch (Exception $exception) {
	// Fall back to Travis env vars.
}

class RevelTest extends TestCase {

	/**
	 * @return Revel
	 */
	public function testRevel() {
		return new Revel(getenv('DOMAIN'), getenv('SECRET'), getenv('KEY'));
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 *
	 * @return Order
	 */
	public function testOrder(Revel $revel) {
		return Order::one($revel);
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testFullUrl(Revel $revel) {
		$this->assertEquals($revel->fullUrl(), 'https://' . getenv('DOMAIN') . '.revelup.com');
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testAuth(Revel $revel) {
		$this->assertEquals($revel->auth(), getenv('KEY') . ':' . getenv('SECRET'));
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testFindEstablishmentById(Revel $revel) {
		$establishment = $revel->establishments()->findById(1);

		$this->assertEquals($establishment->id, 1);
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testFindProduct(Revel $revel) {
		$product = $revel->products()->findById(1);

		$this->assertEquals($product->id, 1);
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testGetRelatedEstablishmentFromProduct(Revel $revel) {
		$product = $revel->products()->findById(1);
		$establishment = $product->establishment();

		$this->assertEquals($product->establishmentId, $establishment->id);
	}

	/**
	 * @depends testRevel
	 * @depends testOrder
	 *
	 * @param Revel $revel
	 * @param Order $order
	 */
	public function testDefaultOrder(Revel $revel, Order $order) {
		$this->assertEquals($order->items, []);
		$this->assertEquals($order->establishmentId, null);
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testProductsFindByBarcode(Revel $revel) {
		$this->assertEquals($revel->products()->findByBarcode('10001')->barcode, '10001');
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testProductsFindByUUID(Revel $revel) {
		$this->assertEquals($revel->products()->findByUUID('fcc5df58-a5f4-4808-b233-561f33d4d157')->uuid, 'fcc5df58-a5f4-4808-b233-561f33d4d157');
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testProductBelongsToValidCategory(Revel $revel) {
		$product = $revel->products()->findById(85);
		$category = $revel->categories()->findById(14);

		$this->assertEquals($product->category()->id, 14);
		$this->assertEquals($product->category()->name, $category->name);
	}

	/**
	 * @depends testRevel
	 * @param Revel $revel
	 */
	public function testSubmitOrder(Revel $revel) {
		$order = Order::one($revel, [
			'establishmentId' => 1,
			'orderInfo' => OrderInfo::one($revel, []),
			'paymentInfo' => PaymentInfo::one($revel, [
				'transactionId' => uniqid(),
				'amount' => 15
			]),
			'items' => [
				OrderItem::one($revel, [
					'productId' => 91,
					'price' => 15,
					'modifiers' => [
						OrderItemModifier::one($revel, [
							'modifierId' => 12
						])
					]
				])
			]
		]);

		$this->assertNotNull($revel->ordering()->submit($order));
	}

}
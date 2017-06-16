<?php

use PHPUnit\Framework\TestCase;
use Revel\Revel;
use Dotenv\Dotenv;

require(realpath(__DIR__ . '/../vendor/autoload.php'));

$env = new Dotenv(__DIR__);
$env->load();

class RevelTest extends TestCase {

	public function revel() {
		return new Revel(
			getenv('domain'),
			getenv('secret'),
			getenv('key')
		);
	}

	/**
	 * @depends revel
	 */
	public function testFullUrl(Revel $revel) {
		$this->assertEquals($revel->fullUrl(), 'https://' . getenv('domain') . '.revelup.com');
	}

	/**
	 * @depends revel
	 */
	public function testAuth(Revel $revel) {
		$this->assertEquals($revel->auth(), getenv('key') . ':' . getenv('secret'));
	}

}
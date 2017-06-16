<?php

require(realpath(__DIR__ . '/../vendor/autoload.php'));

use PHPUnit\Framework\TestCase;
use Revel\Revel;
use Dotenv\Dotenv;

try {
	(new Dotenv(realpath(__DIR__ .'/../')))->load();
} catch (Exception $exception) {
	// Fall back to Travis env vars.
}

class RevelTest extends TestCase {

	public function revel() {
		return new Revel(getenv('DOMAIN'), getenv('SECRET'), getenv('KEY'));
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
<?php namespace Revel\Api;

use Revel\Models\Establishment;

class Establishments extends Api {

	public function all() {
		return $this->cache('all', function() {
			$response = $this->call('GET', '/enterprise/Establishment');

			return Establishment::many($response->objects());
		});
	}

}
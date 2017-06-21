<?php namespace Revel\Api;

use Revel\Models\Modifier;

class Modifiers extends Api {

	public function all() {
		return $this->cache('all', function() {
			return Modifier::many($this->revel, $this->get('/resources/Modifier?limit=1000')->objects());
		});
	}

}
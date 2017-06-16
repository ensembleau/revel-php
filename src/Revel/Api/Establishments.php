<?php namespace Revel\Api;

class Establishments extends Api {

	public function all() {
		return $this->cache('all', function() {
			$data = $this->call('GET', '/enterprise/Establishment');

			if (!empty($data)) return RevelEstablishmentModel::createMany($data->objects);
			return array();
		});
	}

}
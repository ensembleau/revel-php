<?php namespace Revel\Models;

/**
 * @property-read int $id
 * @property-read string $title
 */
class Establishment extends Model {

	protected function fields() {
		return [
			'id' => 'id',
			'title' => 'about_title'
		];
	}

}
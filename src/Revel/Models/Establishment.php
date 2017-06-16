<?php namespace Revel\Models;

/**
 * An establishment.
 *
 * @property-read int $id
 * @property-read string $title
 * @property-read string $name
 * @property-read string $email
 * @property-read string $phone
 * @property-read bool $active
 *
 * @author Marty Wallace
 */
class Establishment extends Model {

	protected function fields() {
		return [
			'id' => 'id',
			'title' => 'about_title',
			'name' => 'name',
			'email' => 'email',
			'phone' => 'phone',
			'active' => 'active'
		];
	}

}
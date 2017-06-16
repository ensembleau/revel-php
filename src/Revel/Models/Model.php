<?php namespace Revel\Models;

abstract class Model {

	/**
	 * Create one instance of this Model from source data.
	 *
	 * @param mixed $data The source data.
	 *
	 * @return static
	 */
	public static function one($data) {
		return new static($data);
	}

	/**
	 * Create multiple instance of this Model from a list of source data.
	 *
	 * @param array|mixed $data The source data.
	 *
	 * @return static[]
	 */
	public static function many($data) {
		return array_map(function($instance) {
			return static::one($instance);
		}, $data);
	}

	/** @var array */
	private $_data;

	/**
	 * Model constructor.
	 *
	 * @see Model::one()
	 * @see Model::many()
	 *
	 * @param mixed $data The data to populate this Model with.
	 */
	public function __construct($data) {
		foreach ($this->fields() as $local => $foreign) {
			if (is_array($data) && array_key_exists($foreign, $data)) $this->_data[$local] = $data[$foreign];
			else if (is_object($data) && property_exists($data, $foreign)) $this->_data[$local] = $data->{$foreign};
		}
	}

	/** @return array */
	abstract protected function fields();

}
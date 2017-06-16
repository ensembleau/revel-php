<?php namespace Revel\Models;

use JsonSerializable;

abstract class Model implements JsonSerializable {

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

	private $_raw;

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
		$this->_raw = $data;
		$this->_data = $this->fields($data);
	}

	public function __get($prop) {
		if (array_key_exists($prop, $this->_data)) {
			return $this->_data[$prop];
		}

		return null;
	}

	/**
	 * Get raw field data as seen in the API response.
	 *
	 * @param string $field The field to get data for.
	 * @param mixed $fallback A fallback to use if the data does not exist.
	 *
	 * @return mixed
	 */
	public function raw($field, $fallback = null) {
		if (is_array($this->_raw) && array_key_exists($field, $this->_raw)) return $this->_raw[$field];
		else if (is_object($this->_raw) && property_exists($this->_raw, $field)) return $this->_raw->{$field};

		return $fallback;
	}

	public function jsonSerialize() {
		return $this->_data;
	}

	/** @return array */
	abstract protected function fields();

	/**
	 * @return array
	 */
	public function data() {
		return $this->_data;
	}

}
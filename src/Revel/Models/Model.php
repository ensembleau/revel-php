<?php namespace Revel\Models;

use JsonSerializable;
use Revel\Revel;

abstract class Model implements JsonSerializable {

	/**
	 * Create one instance of this Model from source data.
	 *
	 * @param Revel $revel The Revel instance that created this model.
	 * @param mixed $data The source data.
	 *
	 * @return static
	 */
	public static function one(Revel $revel, $data) {
		return new static($revel, $data);
	}

	/**
	 * Create multiple instance of this Model from a list of source data.
	 *
	 * @param Revel $revel The Revel instance that created these models.
	 * @param array|mixed $data The source data.
	 *
	 * @return static[]
	 */
	public static function many(Revel $revel, $data) {
		return array_map(function($instance) use ($revel) {
			return static::one($revel, $instance);
		}, $data);
	}

	/** @var Revel */
	protected $revel;

	/** @var mixed */
	private $_raw;

	/** @var array */
	private $_data;

	/**
	 * Model constructor.
	 *
	 * @see Model::one()
	 * @see Model::many()
	 *
	 * @param Revel $revel The Revel instance that created this model.
	 * @param mixed $data The data to populate this Model with.
	 */
	public function __construct($revel, $data) {
		$this->revel = $revel;
		$this->_raw = $data;
		$this->_data = $this->fields();
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
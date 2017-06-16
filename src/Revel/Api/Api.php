<?php namespace Revel\Api;

use Revel\Revel;

abstract class Api {

	/** @var array */
	private $_cache = [];

	/** @var Revel */
	protected $revel;

	/**
	 * Api constructor.
	 *
	 * @param Revel $revel Reference to the core {@link Revel} object.
	 */
	public function __construct(Revel $revel) {
		$this->revel = $revel;
	}

	/**
	 * Builds an API URL relative to {@link getFullUrl()}.
	 *
	 * @param string $resource The resource relative to {@link getFullUrl()}.
	 *
	 * @return string
	 */
	protected function buildApiUrl($resource) {
		return $this->revel->fullUrl() . '/' . ltrim($resource, '/');
	}

	/**
	 * Perform a Revel API request.
	 *
	 * @param string $method The HTTP method.
	 * @param string $resource The API endpoint, relative to the domain.
	 * @param array $body The request body.
	 *
	 * @return Response
	 */
	protected function call($method, $resource, array $body = []) {
		return new Response($this->revel->guzzle()->request($method, $this->buildApiUrl($resource), [
			'headers' => [
				'API-AUTHENTICATION' => $this->revel->auth()
			],
			'json' => $body
		]));
	}

	/**
	 * Cache the result of the API call for future access.
	 *
	 * @param string $key Unique key.
	 * @param mixed|callable $value
	 *
	 * @return mixed
	 */
	public function cache($key, $value) {
		if (!array_key_exists($key, $this->_cache)) {
			$this->_cache[$key] = is_callable($value) ? $value() : $value;
		}

		return $this->_cache[$key];
	}

}
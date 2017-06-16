<?php namespace Revel;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Revel {

	/** @var string */
	private $_domain;

	/** @var string */
	private $_secret;

	/** @var string */
	private $_key;

	/** @var Client */
	private $_client;

	/**
	 * Revel constructor.
	 *
	 * @param string $domain The Revel domain prefix.
	 * @param string $secret The Revel API secret, provided by Revel.
	 * @param string $key The Revel API key, provided by Revel.
	 */
	public function __construct($domain, $secret, $key) {
		$this->_domain = $domain;
		$this->_secret = $secret;
		$this->_key = $key;

		$this->_client = new Client();
	}

	/**
	 * Get the API-AUTHENTICATION header.
	 *
	 * @return string
	 */
	public function getAuth() {
		return $this->_key . ':' . $this->_secret;
	}

	/**
	 * Get the full API URL e.g. `https://<domain>.revelup.com`. Never contains a trailing slash.
	 *
	 * @return string
	 */
	public function getFullUrl() {
		return 'https://' . $this->_domain . '.revelup.com';
	}

	/**
	 * Builds an API URL relative to {@link getFullUrl()}.
	 *
	 * @param string $resource The resource relative to {@link getFullUrl()}.
	 *
	 * @return string
	 */
	public function buildApiUrl($resource) {
		return $this->getFullUrl() . '/' . ltrim($resource, '/');
	}

	/**
	 * Perform a Revel API request.
	 *
	 * @param string $method The HTTP method.
	 * @param string $resource The API endpoint, relative to the domain.
	 * @param array $body The request body.
	 *
	 * @return ResponseInterface
	 */
	public function api($method, $resource, array $body = array()) {
		return $this->_client->request($method, $this->buildApiUrl($resource), [
			'headers' => array(
				'API-AUTHENTICATION' => $this->getAuth()
			),
			'json' => $body
		]);
	}

}
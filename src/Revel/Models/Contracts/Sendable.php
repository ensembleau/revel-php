<?php namespace Revel\Models\Contracts;

interface Sendable {

	/**
	 * Bundle this model for send through the API.
	 *
	 * @return array
	 */
	public function bundle();

}
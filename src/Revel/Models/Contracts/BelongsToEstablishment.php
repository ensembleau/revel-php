<?php namespace Revel\Models\Contracts;

use Revel\Models\Establishment;

interface BelongsToEstablishment {

	/**
	 * @return Establishment
	 */
	public function establishment();

}
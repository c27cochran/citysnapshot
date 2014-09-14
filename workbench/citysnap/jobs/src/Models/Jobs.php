<?php namespace Citysnap\Jobs\Models;

use Platform\Attributes\Models\Entity;

class Jobs extends Entity {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'jobs';

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $with = [
		'values.attribute',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $eavNamespace = 'citysnap/jobs.jobs';

}

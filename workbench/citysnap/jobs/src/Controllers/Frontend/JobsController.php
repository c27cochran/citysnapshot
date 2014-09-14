<?php namespace Citysnap\Jobs\Controllers\Frontend;

use Platform\Foundation\Controllers\BaseController;
use View;

class JobsController extends BaseController {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return View::make('citysnap/jobs::index');
	}

}

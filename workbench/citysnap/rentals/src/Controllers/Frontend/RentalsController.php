<?php namespace Citysnap\Rentals\Controllers\Frontend;

use Platform\Foundation\Controllers\BaseController;
use View;


class RentalsController extends BaseController {

    /**
     * Return the main view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return View::make('citysnap/rentals::index');
    }


} 
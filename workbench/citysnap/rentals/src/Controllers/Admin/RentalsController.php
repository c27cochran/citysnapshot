<?php namespace Citysnap\Rentals\Controllers\Admin;

use Platform\Admin\Controllers\Admin\AdminController;

class RentalsController extends AdminController {

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
<?php namespace Citysnap\Jobs\Controllers\Admin;

use Platform\Admin\Controllers\Admin\AdminController;
use View;

class JobsController extends AdminController {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return View::make('citysnap/jobs::index');
	}

    /**
     * Return the jobs view for linked in api.
     *
     * @return \Illuminate\View\View
     */
    public function linkedinAPI()
    {
        return View::make('citysnap/jobs::linkedin');
    }

    public function listJobTitles()
    {
        $categoryNumber = $_GET['jc'];

        $minRating = $_GET['minRating'];

        $json_url = 'http://api.glassdoor.com/api/api.htm?t.p=24413&t.k=eaqHaPANkyM&userip=&useragent=&format=json&v=1&action=jobs-stats&returnStates=true&admLevelRequested=1&city=Austin&state=Texas&returnJobTitles=true&r=20&jobType=fulltime&jc='.$categoryNumber.'&minRating='.$minRating.'&returnEmployers=true';

        $str = file_get_contents($json_url);

        return $str;

    }

    public function listJobTitleStats()
    {
        $jobTitle = $_GET['jobTitle'];

        $json_url = 'http://api.glassdoor.com/api/api.htm?t.p=24413&t.k=eaqHaPANkyM&userip=&useragent=&format=json&v=1&action=jobs-prog&countryId=1&jobTitle='.rawurlencode($jobTitle).'';

        $str = file_get_contents($json_url);

        return $str;

    }

    public function getEmployerData()
    {
        $employerId = $_GET['id'];

        $json_url = 'http://api.glassdoor.com/api/api.htm?v=1&format=json&t.p=24413&t.k=eaqHaPANkyM&action=employer-review&userip=&useragent=&employerId='.$employerId.'';

        $str = file_get_contents($json_url);

        return $str;
    }

}

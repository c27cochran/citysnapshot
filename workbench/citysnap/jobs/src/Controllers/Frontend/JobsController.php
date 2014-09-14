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

    public function listJobTitles()
    {
        $categoryNumber = $_GET['jc'];

        $minRating = $_GET['minRating'];

        $json_url = 'http://api.glassdoor.com/api/api.htm?t.p=24413&t.k=eaqHaPANkyM&userip=&useragent=&format=json&v=1&action=jobs-stats&returnStates=true&admLevelRequested=1&city=Austin&state=Texas&returnJobTitles=true&jobType=fulltime&jc='.$categoryNumber.'&minRating='.$minRating.'&returnEmployers=true';

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

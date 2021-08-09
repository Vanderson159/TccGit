<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		echo view('header.php');
		echo view('site.php');
		echo view('footer.php');
	}
}

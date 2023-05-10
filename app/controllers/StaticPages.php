<?php

namespace App\Controllers;

use App\Modules\System\ControllerInterface;
use App\Modules\System\View;

class StaticPages implements ControllerInterface
{
	public function about()
	{
		$view = new View();
		$view->show('about', []);
	}
}
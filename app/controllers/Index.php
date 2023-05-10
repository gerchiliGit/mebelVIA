<?php

namespace App\Controllers;

use App\Modules\System\Catalog;
use App\Modules\System\Container;
use App\Modules\System\ControllerInterface;
use App\Modules\System\View;

class Index implements ControllerInterface
{
	public function index()
	{
		$catalogOb = Container::getInstance()->get(Catalog::class);
		$catalog = $catalogOb->getCatalog();
		$view = new View();
		$view->show('main', $catalog);
	}
}
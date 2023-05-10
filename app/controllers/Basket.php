<?php

namespace App\Controllers;

use App\Modules\System\Container;
use App\Modules\System\ControllerInterface;
use App\Modules\System\HttpContext;
use App\Modules\System\View;

class Basket implements ControllerInterface
{
	public function addProduct()
	{
		$basket = new \App\Modules\System\Basket();
		$basket->addProduct();
	}

	public function getBasket()
	{
		$view = new View();
		$basketOb = new \App\Modules\System\Basket();
		$basket = $basketOb->getBasket();
		$view->show('basket', $basket);
	}

	public function deleteProduct()
	{
		$basketOb = new \App\Modules\System\Basket();
		$basketOb->deleteProduct();
	}
}
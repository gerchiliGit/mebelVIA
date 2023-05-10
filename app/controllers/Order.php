<?php

namespace App\Controllers;

use App\Modules\System\ControllerInterface;
use App\Modules\System\View;

class Order implements ControllerInterface
{
	public function createOrder()
	{
		$order = new \App\Modules\System\Order();
		$order->createOrder();
	}

	public function getOrders()
	{
		$view = new View();
		$order = new \App\Modules\System\Order();
		$orders = $order->getOrders();
		$view->show('orders', $orders);
	}
}
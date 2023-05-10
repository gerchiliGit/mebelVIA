<?php

namespace App\Modules\System;

use mysql_xdevapi\Exception;

class Order
{
	public function createOrder()
	{
		$user = Container::getInstance()->get(User::class);
		$db = Container::getInstance()->get(Db::class);
		$httpContext = Container::getInstance()->get(HttpContext::class);
		if($user->isAuthorized())
		{
			try {
				$userId = $user->getId();
				$city = $httpContext->getPostOption('city');
				$address = $httpContext->getPostOption('address');
				if(!$city || !$address)
				{
					$session = Container::getInstance()->get(Session::class);
					$session->set('ORDER_ERROR', 'Введите название города и адрес доставки.');
					header('Location: /basket/');
					die();
				}
				$sql = "SELECT * FROM `cities` WHERE `name` = :name";
				$result = $db->sqlExecution($sql, [$city]);
				if(!isset($result['data'][0]['id']))
				{
					$sql = "INSERT INTO `mebelVIA`.`cities` (`name`, `country`) VALUES (:name, '1');";
					$result = $db->sqlExecution($sql, [$city]);
					$cityId = $result['id'];
				}else
				{
					$cityId = $result['data'][0]['id'];
				}
				$sql = "INSERT INTO `mebelVIA`.`deliveries` (`country`, `city`, `delivery_type`, `address`) VALUES ('1', :city, '1', :address);";
				$result = $db->sqlExecution($sql, [$cityId, $address]);
				$deliveryId = $result['id'];
				$createdDate = date('Y-m-j G:i:s');
				$sql = "INSERT INTO `mebelVIA`.`payments` (`created_date`, `paid`, `payment_type`) VALUES (:createdDate, '0', '1');";
				$result = $db->sqlExecution($sql, [$createdDate]);
				$paymentId = $result['id'];
				$sql = "INSERT INTO `mebelVIA`.`orders` (`created_date`, `status`, `delivery`, `payment`, `user`) VALUES (:createdDate, '1', :delivery, :payment, :user);";
				$db->sqlExecution($sql, [$createdDate, $deliveryId, $paymentId, $userId]);
				$sql = "DELETE FROM `mebelVIA`.`basket` WHERE (`user` = :userId);";
				$db->sqlExecution($sql, [$userId]);
			}catch (Exception $exception)
			{
				echo $exception->getMessage();
			}
		}
		header('Location: /');
		die();
	}

	public function getOrders()
	{
		$user = Container::getInstance()->get(User::class);
		$db = Container::getInstance()->get(Db::class);
		if($user->isAuthorized())
		{
			try {
				$userId = $user->getId();
				$sql = "SELECT * FROM `orders` WHERE `user` = :user";
				$result = $db->sqlExecution($sql, [$userId]);
				if($result['data'])
				{
					return $result['data'];
				}
			}catch (\Exception $exception)
			{

			}
		}
	}
}
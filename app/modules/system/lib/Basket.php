<?php

namespace App\Modules\System;

use mysql_xdevapi\Exception;

class Basket
{
	public function addProduct()
	{
		$user = Container::getInstance()->get(User::class);
		$db = Container::getInstance()->get(Db::class);
		if($user->isAuthorized())
		{
			try {
				$product_id = $_REQUEST['MATCHES'][1];
				$user_id = $user->getId();
				$sql = "SELECT * FROM `basket` WHERE `product` = :product AND `user` = :user;";
				$hasBasket = $db->sqlExecution($sql, [$product_id, $user_id]);
				if($hasBasket['data'])
				{
					$count = ++$hasBasket['data'][0]['count'];
					$sql = "UPDATE `mebelVIA`.`basket` SET `count` = :count WHERE (`product` = :product) and (`user` = :user);";
					$result = $db->sqlExecution($sql, [$count, $product_id, $user_id]);
					if($result['status'])
					{
						header('Location: /basket/');
						die();
					}
				}
				$sql = "INSERT INTO `mebelVIA`.`basket` (`product`, `user`, `count`) VALUES (:product, :user, '1');";
				$result = $db->sqlExecution($sql, [$product_id, $user_id]);
				if($result['status'])
				{
					header('Location: /basket/');
					die();
				}
			}catch (Exception $exception)
			{
				echo $exception->getMessage();
			}
		}
		header('Location: /signin/');
		die();
	}

	public function getBasket()
	{
		$user = Container::getInstance()->get(User::class);
		$db = Container::getInstance()->get(Db::class);
		if($user->isAuthorized())
		{
			try {
				$user_id = $user->getId();
				$sql = "SELECT * FROM `basket` JOIN `products` ON `basket`.`product` = `products`.`id`WHERE `user` = :user;";
				$result = $db->sqlExecution($sql, [$user_id]);
				$count = 0;
				$sum = 0;
				foreach ($result['data'] as $product)
				{
					if($product['availability'] > 0)
					{
						$count += $product['count'];
						$sum += $product['price'] * $product['count'];
					}
				}
				$result['count'] = $count;
				$result['sum'] = $sum;
				$sql = "SELECT * FROM `cities`";
				$result['cities'] = $db->sqlExecution($sql);
				return $result;
			}catch (Exception $exception)
			{
				echo $exception->getMessage();
			}
		}
		header('Location: /signin/');
		die();
	}

	public function deleteProduct()
	{
		$user = Container::getInstance()->get(User::class);
		$db = Container::getInstance()->get(Db::class);
		if($user->isAuthorized())
		{
			try {
				$product_id = $_REQUEST['MATCHES'][1];
				$user_id = $user->getId();
				$sql = "DELETE FROM `mebelVIA`.`basket` WHERE (`product` = :product) and (`user` = :user);";
				$result = $db->sqlExecution($sql, [$product_id, $user_id]);
				if($result['status'])
				{
					header('Location: /basket/');
					die();
				}
			}catch (Exception $exception)
			{
				echo $exception->getMessage();
			}
		}
		header('Location: /signin/');
		die();
	}
}
<?php

use App\Modules\System\Route;

return [
	'example/{int}/{string}' => new Route('Example', 'example'),
	'/' => new Route('Index', 'index'),
	'/signin/' => new Route('Signin', 'index'),
	'/signin/do' => new Route('Signin', 'signIn'),
	'/signup/' => new Route('Signup', 'index'),
	'/signup/do' => new Route('Signup', 'signUp'),
	'/logout/' => new Route('Signin', 'logout'),
	'/basket/add/{int}' => new Route('Basket', 'addProduct'),
	'/basket/' => new Route('Basket', 'getBasket'),
	'/basket/delete/{int}' => new Route('Basket', 'deleteProduct'),
	'/orders/create/' => new Route('Order', 'createOrder'),
	'/orders/' => new Route('Order', 'getOrders'),
	'/about/' => new Route('StaticPages', 'about'),
];
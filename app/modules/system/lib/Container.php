<?php

namespace App\Modules\System;

class Container
{
	protected array $services;
	protected array $cachedServices;
	static protected Container $instance;

	private function __construct()
	{
		$this->services = [
			Router::class => fn() => new Router(),
			Controller::class => fn() => new Controller(),
			Configuration::class => fn() => new Configuration(),
			Db::class => fn() => new Db(self::get(Configuration::class)),
			Session::class => fn () => new Session(),
			User::class => fn() => new User(self::get(Db::class), self::get(Session::class)),
			HttpContext::class => fn() => new HttpContext(),
			Catalog::class => fn() => new Catalog(self::get(Db::class)),
		];
	}

	static public function getInstance() : Container
	{
		if(!isset(self::$instance))
		{
			self::$instance = new Container();
		}
		return self::$instance;
	}

	public function get(string $id)
	{
		if(isset($this->cachedServices[$id]))
		{
			return $this->cachedServices[$id];
		}
		$this->cachedServices[$id] = $this->services[$id]();
		return $this->cachedServices[$id];
	}
}
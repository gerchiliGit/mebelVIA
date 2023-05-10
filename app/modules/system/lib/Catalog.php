<?php

namespace App\Modules\System;

class Catalog
{
	protected Db $db;

	public function __construct(Db $db)
	{
		$this->db = $db;
	}

	public function getCatalog() : array
	{
		$sql = "SELECT * FROM `products`";
		$catalog = $this->db->sqlExecution($sql);
		if($catalog['status'])
		{
			return $catalog['data'];
		}
		return [];
	}
}
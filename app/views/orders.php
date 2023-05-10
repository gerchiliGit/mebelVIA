<?
$this->setTitle('Мои заказы');
?>
<div class="container-fluid">
	<ul class="list-group">
        <?foreach($result as $order):?>
            <li class="list-group-item">Заказ #<?=$order['id']?> Создан: <?=$order['created_date']?> Статус: принят</li>
        <?endforeach;?>
	</ul>
</div>

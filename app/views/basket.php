<?
$this->setTitle('Корзина');
$session = \App\Modules\System\Container::getInstance()->get(\App\Modules\System\Session::class);
?>
<div class="container row">
	<h2 class="m-t-0">Корзина</h2>
</div>
<div class="container-fluid d-flex">
	<div class="container row col-sm-4 col-md-6 col-lg-8">
		<ul class="list-group">
            <?foreach ($result['data'] as $product):?>
                <li class="list-group-item <?=$product['availability'] < 1?'disabled':''?>" <?=$product['availability'] < 1?'aria-disabled="true"':''?>>
                    <div class="container-fluid">
                        <div class="card-body">
                            <p class="card-text"><?=$product['name']?></p>
                            <?if($product['availability'] < 1):?>
                                <div class="alert alert-danger" role="alert">
                                    Нет в наличии
                                </div>
                            <?endif;?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/basket/delete/<?=$product['product']?>" type="button" class="btn btn-danger">Удалить из корзины</a>
                                </div>
                                <h4>Кол-во: <?=$product['count']?></h4>
                                <h4><?=$product['price']?> ₽</h4>
                            </div>
                        </div>
                    </div>
                </li>
            <?endforeach;?>
		</ul>
	</div>
    <div class="container row col-md-6 col-lg-4">
        <div class="container-fluid">
            <h4>Оформление заказа</h4>
            <p>Всего товаров <?=$result['count']?></p>
            <p>На сумму <?=$result['sum']?> ₽</p>
            <h4>Доставка</h4>
            <form action="/orders/create/" method="post">
                <label for="exampleDataList" class="form-label">Выберите город</label>
                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Выберите город..." name="city">
                <datalist id="datalistOptions">
                    <?foreach ($result['cities']['data'] as $city):?>
                    <option value="<?=$city['name']?>">
                    <?endforeach;?>
                </datalist>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ул. Большая д.9 кв.78" name="address">
                </div>
                <button class="btn btn-success <?=$result['count']?'':'disabled'?>">Оформить</button>
                <?if($session->has('ORDER_ERROR')):?>
                    <div class="alert alert-danger mt-3" role="alert"><?=$session->get('ORDER_ERROR')?></div>
                <?endif;?>
            </form>
        </div>
    </div>
</div>

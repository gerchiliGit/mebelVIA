<?
$this->setTitle('Магазин поддержанной мебели mebel VIA');
?>
<div class="container row">
    <h2 class="m-t-0">Каталог</h2>
</div>
<div class="container">
	<div class="row">
		<?foreach ($result as $product):?>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                        <img class="card-img-top" data-src="<?=$product['detail_picture']?>" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?=$product['detail_picture']?>" data-holder-rendered="true">
                    <div class="card-body">
                        <p class="card-text"><?=$product['name']?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <?if($product['availability'] > 0):?>
                                    <a href="/basket/add/<?=$product['id']?>" type="button" class="btn btn-success">В корзину</a>
                                <?else:?>
                                    <a type="button" class="btn btn-danger disabled">Нет в наличии</a>
                                <?endif;?>
                            </div>
                            <small class="text-muted"><?=$product['price']?> ₽</small>
                        </div>
                    </div>
                </div>
            </div>
		<?endforeach;?>
	</div>
</div>
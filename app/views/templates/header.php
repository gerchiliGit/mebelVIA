<?
use App\Modules\System\Container;
use App\Modules\System\User;
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	<title>#TITLE#</title>
</head>
<body>
<div class="container-fluid">
	<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
		<a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
			MEBEL_VIA
		</a>

		<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
			<li><a href="/" class="nav-link px-2 link-dark">Каталог</a></li>
			<?
			$user = Container::getInstance()->get(User::class);
			if($user->isAuthorized()):
			?>
                <li><a href="/basket/" class="nav-link px-2 link-dark">Корзина</a></li>
                <li><a href="/orders/" class="nav-link px-2 link-dark">Заказы</a></li>
            <?endif;?>
			<li><a href="/about/" class="nav-link px-2 link-dark">О магазине</a></li>
		</ul>

		<div class="col-md-3 text-end">
            <?
            $user = Container::getInstance()->get(User::class);
            if($user->isAuthorized()):
            ?>
			<a href="/logout/" type="button" class="btn btn-outline-primary me-2">Выйти</a>
            <?else:?>
            <a href="/signin/" type="button" class="btn btn-outline-primary me-2">Войти</a>
            <?endif;?>
		</div>
	</header>
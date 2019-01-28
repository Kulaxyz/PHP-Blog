<div><a href="<?=ROOT?>Articles">Главная <br></a><div>

<div><?=$errors ?? null?></div>
<form method="post">
	Введите логин<br>
	<input type="text" name="login" value="<?=$params['login'] ?? null?>"><br>
	Введите email<br>
	<input type="email" name="email" value="<?=$params['email'] ?? null?>"><br>
	Введите пароль<br>	
	<input type="password" name="password"><br>
	Введите пароль ещё раз<br>	
	<input type="password" name="password2"><br>

	<input type="submit", value="Зарегистрироваться"> <br>

	
</form>
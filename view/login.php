<div><a href="<?=ROOT?>Articles">Главная <br></a><div>

<form method="post">
	Введите имя<br>
	<input type="text" name="login"><br>
	Введите пароль<br>	
	<input type="password" name="password"><br>
	<input type="checkbox" name="remember">Запомнить <br>
	<input type="submit" value="Войти"><br>
	<div><?=$msg?></div>
	
</form>
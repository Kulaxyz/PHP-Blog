<div><a href="<?=ROOT?>Articles">Главная <br></a><div>

<form method="post">
	Введите логин<br>
	<input type="text" name="login"><br>
	Введите имя или никнейм<br>
	<input type="text" name="username"><br>
	Введите пароль<br>	
	<input type="password" name="password"><br>
	Введите пароль ещё раз<br>	
	<input type="password" name="password2"><br>

	<input type="submit", value="Зарегистрироваться"> <br>
	<div><?=$msg?></div>

	
</form>
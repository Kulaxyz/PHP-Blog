<div><a href="<?=ROOT?>Articles">Главная</a></div><br>
<div><?=$errors ?? null?></div>
<form method="post">
<h3>Название статьи</h3>
<input type="text" name="title" value="<?=$params['title'] ?? null?>"> <br>
<h5>Контент</h5>
<textarea name="content"><?=$params['content'] ?? null?></textarea><br><br>
<h5>Автор</h5>
<input type="text" name="author" value="<?=$params['author'] ?? null?>"> <br><br>
<input type="submit" value="Опубликовать"><br>
</form>

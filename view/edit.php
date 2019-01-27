<div><a href="<?=ROOT?>Articles">Главная</a></div><br>
<form method="post">
<h3>Название статьи</h3>
<input type="text" name="title" value="<?=$title?>"> <br>
<h5>Контент</h5>
<textarea name="content"><?=$content?></textarea><br><br>
<h5>Автор</h5>
<input type="text" name="author" value="<?=$author?>"> <br><br>
<input type="submit" value="Опубликовать"><br>
</form>
<?=$errors ?? null?>

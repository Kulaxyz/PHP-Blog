<?php error_reporting( E_ERROR );
foreach ($articles as $article):
?>
<em><a href="<?=ROOT?>Articles/<?=$article['id']?>"><?=$article['title']?></a></em>
<em><?=$article['dt']?></em>

<?php
	if($isAuth):
	?>
	<a href="<?=ROOT?>Articles/edit/<?=$article['id']?>">Редактировать</a>
	<a href="<?=ROOT?>Articles/delete/<?=$article['id']?>">Удалить</a><br>
	<?php
	else:
		?></br><?php
	endif;
endforeach;	
if($isAuth): ?>

<a href="<?=ROOT?>Articles/add">Добавить Статью<br></a>
<a href="<?=ROOT?>Users/exit">Выйти <br></a>
<?php

else: ?>
<a href="<?=ROOT?>Users/login">Войти <br></a>
<a href="<?=ROOT?>Users/register">Зарегистрироваться <br></a>
<?php

endif;
?>
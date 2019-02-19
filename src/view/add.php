<div><a href="<?=ROOT?>Articles">Главная <br></a><div>

<div><?=$errors ?? null?></div>
<form method="post" class='sign-up-class'>
	<?=$form->inputSign()?>

	<?php foreach ($form->fields() as $field): ?>
		<div class='form-item'>
			<?=$field?>

		</div>
	<?php endforeach;?>

</form>
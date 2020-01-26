<div class="mt-checkbox-list">

<?php foreach ($users as $key => $user): ?>

	<?php if($rol == 7): ?>
	
		<label class="mt-checkbox"> <?= $user->getIdusuario()->getNombre() ?> <?= $user->getIdusuario()->getApellidos() ?>
	        <input class="users" value="<?= $user->getIdusuario()->getId() ?>" name="user[]" type="checkbox">
	        <span style="background: <?= $user->getIdusuario()->getColor() ?>"></span>
	    </label>

    <?php else: ?>

    	<label class="mt-checkbox"> <?= $user->getNombre() ?> <?= $user->getApellidos() ?>
	        <input class="users" value="<?= $user->getId() ?>" name="user[]" type="checkbox">
	        <span style="background: <?= $user->getColor() ?>"></span>
	    </label>

	<?php endif ?>


<?php endforeach ?>
	

</div>

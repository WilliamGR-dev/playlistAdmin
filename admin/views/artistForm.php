<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<?= $message ?><br>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
ici formulaire de l'artiste<br><br>

- nom (champ text)<br>
- label (slecte area)<br>
- bio (champ textarea)<br>
- image (champ file)<br><br>

<form action="index.php?controller=artists&action=<?= isset($artist) ? 'edit&id='.$artist['id'] : 'add' ?>" method="post" enctype="multipart/form-data">

	<label for="name">Nom :</label>
	<input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($artist) ? $artist['name'] : '' ?>" /><br>
	
	<label for="label">Label :</label>
    <select  name="label" id="label" >
        <?php foreach ($labels as $label): ?>
            <option value="<?= isset($labels) ? $label['id'] : '' ?>"
                <?php if(isset($_SESSION['old_inputs'])):if ($label['id']==$_SESSION['old_inputs']['label']): echo 'selected'; endif;endif; if(isset($artist)):if ($label['id']==$artist['label_id']): echo 'selected'; endif;endif;?>
            ><?= isset($labels) ? $label['name'] : '' ?></option>
        <?php endforeach; ?>
    </select><br>

	<label for="biography">Bio :</label>
	<textarea name="biography" id="biography"><?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['biography'] : '' ?><?= isset($artist) ? $artist['biography'] : '' ?></textarea><br>

	<label for="image">image :</label>
	<input type="file" name="image" id="image" /><br>
	
	<input type="submit" value="Enregistrer" />

</form>
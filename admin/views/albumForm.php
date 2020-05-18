<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
    <div>
        <?php foreach($_SESSION['messages'] as $message): ?>
            <?= $message ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
ici formulaire de l'Album<br><br>

- nom (champ text)<br>
- date (champ date)<br>
- artist (select area)<br><br>

<form action="index.php?controller=albums&action=<?= isset($album) ? 'edit&id='.$album['id'] : 'add' ?>" method="post" enctype="multipart/form-data">

    <label for="name">Nom :</label>
    <input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($album) ? $album['name'] : '' ?>" /><br>

    <label for="name">Date :</label>
    <input  type="date" name="year" id="year" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['year'] : '' ?><?= isset($album) ? $album['year'] : '' ?>" /><br>

    <label for="artist">Artist :</label>
    <select  name="artist" id="artist" >
        <?php foreach ($artists as $artist): ?>
            <option value="<?= isset($artists) ? $artist['id'] : '' ?>"
                <?php if(isset($_SESSION['old_inputs'])):if ($artist['id']==$_SESSION['old_inputs']['artist']): echo 'selected'; endif;endif; if(isset($album)):if ($artist['id']==$album['artist_id']): echo 'selected'; endif;endif;?>
            ><?= isset($artists) ? $artist['name'] : '' ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Enregistrer" />

</form>
<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
    <div>
        <?php foreach($_SESSION['messages'] as $message): ?>
            <?= $message ?><br>
        <?php endforeach;?>
    </div>
<?php endif; ?>
ici formulaire de l'Album<br><br>

- nom (champ text)<br>
- artist (select area)<br>
- album (select area)<br><br>

<form action="index.php?controller=songs&action=<?= isset($song) ? 'edit&id='.$song['id'] : 'add' ?>" method="post" enctype="multipart/form-data">

    <label for="name">Nom :</label>
    <input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($song) ? $song['title'] : '' ?>" /><br>


    <label for="artist">Artist :</label>
    <select  name="artist" id="artist" >
        <?php foreach ($artists as $artist): ?>
            <option value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($artists) ? $artist['id'] : '' ?>"
                <?php if(isset($_SESSION['old_inputs'])):if ($artist['id']== $_SESSION['old_inputs']['artist']): echo 'selected'; endif;endif; if(isset($song)):if ($artist['id']==$song['artist_id']): echo 'selected'; endif;endif;?>
            ><?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($artists) ? $artist['name'] : '' ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="album">Album :</label>
    <select  name="album" id="album" >
        <?php foreach ($albums as $album): ?>
            <option value="<?= isset($albums) ? $album['id'] : '' ?>"
                <?php if(isset($_SESSION['old_inputs'])):if ($album['id']== $_SESSION['old_inputs']['album']): echo 'selected'; endif;endif; if(isset($song)):if ($album['id']==$song['album_id']): echo 'selected'; endif;endif;?>
            ><?= isset($albums) ? $album['name'] : '' ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Enregistrer" />

</form>
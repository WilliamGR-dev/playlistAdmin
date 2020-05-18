<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
    <div>
        <?php foreach($_SESSION['messages'] as $message): ?>
            <?= $message ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h2>ici la liste complète des artistes : </h2>

<?php foreach($albums as $album): ?>
    <p><?= htmlspecialchars($album['name'])?>
        <a href="index.php?controller=artists&action=edit&id=<?= $album['id'] ?>"> modifier</a>
        <a href="index.php?controller=artists&action=delete&id=<?= $album['id'] ?>"> supprimer</a>
    </p>



<?php endforeach; ?>


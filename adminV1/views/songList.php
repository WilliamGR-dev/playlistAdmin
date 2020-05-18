<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
    <div>
        <?php foreach($_SESSION['messages'] as $message): ?>
            <?= $message ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h2>ici la liste complète des albums : </h2>

<?php foreach($songs as $song): ?>
    <p><?= htmlspecialchars($song['name'])?>
        <a href="index.php?controller=artists&action=edit&id=<?= $song['id'] ?>"> modifier</a>
        <a href="index.php?controller=artists&action=delete&id=<?= $song['id'] ?>"> supprimer</a>
    </p>



<?php endforeach; ?>


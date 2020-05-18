<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<?= $message ?><br>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<h2>Ajouter une musique :</h2>

<a href="index.php?controller=songs&action=new"> Ajouter</a>


<h2>Ici la liste complète des musiques : </h2>

<?php foreach($songs as $song ): ?>
	<p><?=  htmlspecialchars($song['title']) ?>
	<a href="index.php?controller=songs&action=edit&id=<?= $song['id'] ?>">modifier</a>
	<a href="index.php?controller=songs&action=delete&id=<?= $song['id'] ?>">supprimer</a></p>
<?php endforeach; ?>


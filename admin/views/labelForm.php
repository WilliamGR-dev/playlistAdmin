<?php require ('partials/header.php'); ?>

<?php require ('partials/menu.php'); ?>

<?php if(isset($_SESSION['messages'])): ?>
    <div>
        <?php foreach($_SESSION['messages'] as $message): ?>
            <?= $message ?><br>
        <?php endforeach;?>
    </div>
<?php endif; ?>
ici formulaire du label<br><br>

- nom (champ text)<br>
- Parent Lalbel (select area)<br><br>

<form action="index.php?controller=labels&action=<?= isset($label) ? 'edit&id='.$label['id'] : 'add' ?>" method="post" enctype="multipart/form-data">

    <label for="name">Nom :</label>
    <input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($label) ? $label['name'] : '' ?>" /><br>

    <label for="label">Parent Label :</label>
    <select  name="label" id="label" >
        <option value="">Aucun Parent Label</option>
        <?php foreach ($parentLabels as $parentLabel): ?>
            <option value="<?= isset($parentLabels) ? $parentLabel['id'] : '' ?>"
                <?php if(isset($_SESSION['old_inputs'])):if ($parentLabel['id']==$_SESSION['old_inputs']['label']): echo 'selected'; endif;endif; if(isset($label)):if ($parentLabel['id']==$label['parent_id']): echo 'selected'; endif;endif;?>
            ><?= isset($parentLabels) ? $parentLabel['name'] : '' ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Enregistrer" />

</form>
<?php

function getAllLabels()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM labels');
	$labels =  $query->fetchAll();

    return $labels;
}

function getLabel($id)
{
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM labels WHERE id = ?");
    $query->execute([
        $id
    ]);

    $result = $query->fetch();

    return $result;
}

function addLabel($informations)
{
    $db = dbConnect();
    $parent_id = $informations['label'];
    if ($parent_id == null){
        $parent_id = null;
    }

    $query = $db->prepare("INSERT INTO labels (name, parent_id) VALUES( :name, :parent_id)");
    $result = $query->execute([
        'name' => $informations['name'],
        'parent_id' => $parent_id
    ]);

    return $result;
}

function updateLabel($id, $informations)
{
    $db = dbConnect();

    $parent_id = $informations['label'];
    if ($parent_id == null){
        $parent_id = null;
    }

    $query = $db->prepare('UPDATE labels SET name = ?, parent_id = ? WHERE id = ?');

    $result = $query->execute(
        [
            $informations['name'],
            $parent_id,
            $id,
        ]
    );

    return $result;
}

function deletLabel($id)
{
    $db = dbConnect();

    $query = $db->prepare('DELETE FROM labels WHERE id = ?');
    $result = $query->execute([$id]);

    return $result;
}
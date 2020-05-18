<?php

function getAllAlbums()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM albums');
	$albums =  $query->fetchAll();

    return $albums;
}

function getAlbum($id)
{
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM albums WHERE id = ?");
    $query->execute([
        $id
    ]);

    $result = $query->fetch();

    return $result;
}

function addAlbum($informations)
{
    $db = dbConnect();
    $new_date = date('Y', strtotime($informations['year']));

    $query = $db->prepare("INSERT INTO albums (name, year, artist_id) VALUES( :name, :year, :artist_id)");
    $result = $query->execute([
        'name' => $informations['name'],
        'year' => $new_date,
        'artist_id' => $informations['artist']
    ]);

    return $result;
}

function updateAlbum($id, $informations)
{
    $db = dbConnect();
    $new_date = date('Y', strtotime($informations['year']));

    $query = $db->prepare('UPDATE albums SET name = ?, year = ?, artist_id = ? WHERE id = ?');

    $result = $query->execute(
        [
            $informations['name'],
            $new_date,
            $informations['artist'],
            $id,
        ]
    );

    return $result;
}

function deletAlbum($id)
{
    $db = dbConnect();

    $query = $db->prepare('DELETE FROM albums WHERE id = ?');
    $result = $query->execute([$id]);

    return $result;
}
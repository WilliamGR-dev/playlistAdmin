<?php

function getAllSongs()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM songs');
	$songs =  $query->fetchAll();

    return $songs;
}

function getSong($id)
{
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM songs WHERE id = ?");
    $query->execute([
        $id
    ]);

    $result = $query->fetch();

    return $result;
}

function addSong($informations)
{
    $db = dbConnect();

    $query = $db->prepare("INSERT INTO songs (title, album_id, artist_id) VALUES( :title, :album_id, :artist_id)");
    $result = $query->execute([
        'title' => $informations['name'],
        'album_id' => $informations['album'],
        'artist_id' => $informations['artist']
    ]);

    return $result;
}

function updateSong($id, $informations)
{
    $db = dbConnect();

    $query = $db->prepare('UPDATE songs SET title = ?, album_id = ?, artist_id = ? WHERE id = ?');

    $result = $query->execute(
        [
            $informations['name'],
            $informations['album'],
            $informations['artist'],
            $id,
        ]
    );

    return $result;
}

function deletSong($id)
{
    $db = dbConnect();

    $query = $db->prepare('DELETE FROM songs WHERE id = ?');
    $result = $query->execute([$id]);

    return $result;
}
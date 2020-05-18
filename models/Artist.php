<?php

function getArtists($artistId = null){
    $db = dbConnect();
    $requestArtists = $db->query('SELECT * FROM artists');
    $artists = $requestArtists->fetchAll();
    return $artists;

}

function getArtist($id){
    $db = dbConnect();
    $requestArtist = $db->query('SELECT * FROM artists WHERE id =' . $id);
    $artist = $requestArtist->fetch();
    return $artist;
}
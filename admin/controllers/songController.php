<?php
if (!isset($_GET['action'])){
    header('Location:index.php');
    exit;
}

require('models/Album.php');
require('models/Artist.php');
require('models/Song.php');

if($_GET['action'] == 'list'){
    $songs = getAllSongs();
	require('views/songList.php');
}
elseif($_GET['action'] == 'new'){
    $artists = getAllArtists();
    $albums = getAllAlbums();
	require('views/songForm.php');
}
elseif($_GET['action'] == 'add'){

	if(empty($_POST['name']) || empty($_POST['artist'])){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
		}
		if(empty($_POST['artist'])){
			$_SESSION['messages'][] = 'Le champ artist est obligatoire !';
		}
		
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=songs&action=new');
		exit;
	}
	else{
		$resultAdd = addSong($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Musique enregistré !' : "Erreur lors de l'enregistreent de la musique... :(";
		
		header('Location:index.php?controller=songs&action=list');
		exit;
	}
}
elseif($_GET['action'] == 'edit'){
	if (!isset($_GET['id'])){
        header('Location:index.php?controller=songs&action=list');
        exit;
    }
	else{
	    $songExist = getSong($_GET['id']);
	    if (!$songExist){
            header('Location:index.php?controller=songs&action=list');
            exit;
        }

    }


	if(!empty($_POST)){

        if(empty($_POST['name']) || empty($_POST['artist'])){

            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ nom est obligatoire !';
            }
            if(empty($_POST['artist'])){
                $_SESSION['messages'][] = 'Le champ artist est obligatoire !';
            }

            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=songs&action=new');
            exit;
        }
        else {
            $result = updateSong($_GET['id'], $_POST);
            if ($result) {
                $_SESSION['messages'][] = 'Musique mis à jour !';
            } else {
                $_SESSION['messages'][] = 'Erreur lors de la mise à jour... :(';
            }
            header('Location:index.php?controller=songs&action=list');
            exit;
        }
	}
	else{
		$song = getSong($_GET['id']);

        $artists = getAllArtists();
        $albums = getAllAlbums();
		require('views/songForm.php');
	}

}
elseif($_GET['action'] == 'delete'){
	$result = deletSong(   $_GET['id']    );
	if($result){
		$_SESSION['messages'][] = 'Musique supprimé !';
	}
	else{
		$_SESSION['messages'][] = 'Erreur lors de la suppression... :(';
	}
	header('Location:index.php?controller=songs&action=list');
	exit;
}
else{
    header('Location:index.php');
    exit;
}

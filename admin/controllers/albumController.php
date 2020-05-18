<?php
if (!isset($_GET['action'])){
    header('Location:index.php');
    exit;
}

require('models/Album.php');
require('models/Artist.php');

if($_GET['action'] == 'list'){
    $albums = getAllAlbums();
	require('views/albumList.php');
}
elseif($_GET['action'] == 'new'){
    $artists = getAllArtists();
	require('views/albumForm.php');
}
elseif($_GET['action'] == 'add'){

	if(empty($_POST['name']) || empty($_POST['year']) || empty($_POST['artist'])){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
		}
		if(empty($_POST['year'])){
			$_SESSION['messages'][] = 'Le champ date est obligatoire !';
		}
		if(empty($_POST['artist'])){
			$_SESSION['messages'][] = 'Le champ artist est obligatoire !';
		}
		
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=albums&action=new');
		exit;
	}
	else{
		$resultAdd = addAlbum($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Album enregistré !' : "Erreur lors de l'enregistreent de l'album... :(";
		
		header('Location:index.php?controller=albums&action=list');
		exit;
	}
}
elseif($_GET['action'] == 'edit'){

    if (!isset($_GET['id'])){
        header('Location:index.php?controller=albums&action=list');
        exit;
    }
    else{
        $albumExist = getAlbum($_GET['id']);
        if (!$albumExist){
            header('Location:index.php?controller=albums&action=list');
            exit;
        }

    }
	
	if(!empty($_POST)){
        if(empty($_POST['name']) || empty($_POST['year']) || empty($_POST['artist'])){

            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ nom est obligatoire !';
            }
            if(empty($_POST['year'])){
                $_SESSION['messages'][] = 'Le champ date est obligatoire !';
            }
            if(empty($_POST['artist'])){
                $_SESSION['messages'][] = 'Le champ artist est obligatoire !';
            }

            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=albums&action=new');
            exit;
        }
        else {
            $result = updateAlbum($_GET['id'], $_POST);
            if ($result) {
                $_SESSION['messages'][] = 'Album mis à jour !';
            } else {
                $_SESSION['messages'][] = 'Erreur lors de la mise à jour... :(';
            }
            header('Location:index.php?controller=albums&action=list');
            exit;
        }
	}
	else{
		$album = getAlbum($_GET['id']);
		$date = $album['year']."-01-01";
		$album['year'] = date('Y-m-d', strtotime($date));
		$artists = getAllArtists();
		require('views/albumForm.php');
	}

}
elseif($_GET['action'] == 'delete'){
	$result = deletAlbum(   $_GET['id']    );
	if($result){
		$_SESSION['messages'][] = 'Album supprimé !';
	}
	else{
		$_SESSION['messages'][] = 'Erreur lors de la suppression... :(';
	}
	header('Location:index.php?controller=albums&action=list');
	exit;
}
else{
    header('Location:index.php');
    exit;
}


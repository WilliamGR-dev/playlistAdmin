<?php
if (!isset($_GET['action'])){
    header('Location:index.php');
    exit;
}

require('models/Artist.php');
require('models/Label.php');

if($_GET['action'] == 'list'){
	$artists = getAllArtists();
	require('views/artistList.php');
}
elseif($_GET['action'] == 'new'){
    $labels = getAllLabels();
	require('views/artistForm.php');
}
elseif($_GET['action'] == 'add'){
	
	if(empty($_POST['name']) || empty($_POST['label'])){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
		}
		if(empty($_POST['label'])){
			$_SESSION['messages'][] = 'Le champ label est obligatoire !';
		}
		
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=artists&action=new');
		exit;
	}
	else{
		$resultAdd = addArtist($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Artiste enregistré !' : "Erreur lors de l'enregistreent de l'artiste... :(";
		
		header('Location:index.php?controller=artists&action=list');
		exit;
	}
}
elseif($_GET['action'] == 'edit'){

    if (!isset($_GET['id'])){
        header('Location:index.php?controller=artists&action=list');
        exit;
    }
    else{
        $artistExist = getArtist($_GET['id']);
        if (!$artistExist){
            header('Location:index.php?controller=artists&action=list');
            exit;
        }

    }

    if(!empty($_POST)){
        if(empty($_POST['name']) || empty($_POST['label'])){

            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ nom est obligatoire !';
            }
            if(empty($_POST['label'])){
                $_SESSION['messages'][] = 'Le champ label est obligatoire !';
            }

            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=artists&action=new');
            exit;
        }
        else{
            $result = updateArtist($_GET['id'], $_POST);
            if($result){
                $_SESSION['messages'][] = 'Artiste mis à jour !';
            }
            else{
                $_SESSION['messages'][] = 'Erreur lors de la mise à jour... :(';
            }
            header('Location:index.php?controller=artists&action=list');
            exit;
        }
    }
    else{
        $artist = getArtist($_GET['id']);
        $labels = getAllLabels();
        require('views/artistForm.php');
    }



}
elseif($_GET['action'] == 'delete'){
	$result = deleteArtist(   $_GET['id']    );
	if($result){
		$_SESSION['messages'][] = 'Artiste supprimé !';
	}
	else{
		$_SESSION['messages'][] = 'Erreur lors de la suppression... :(';
	}
	header('Location:index.php?controller=artists&action=list');
	exit;
}
else{
    header('Location:index.php');
    exit;
}

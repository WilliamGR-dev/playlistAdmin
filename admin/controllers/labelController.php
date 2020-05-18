<?php
if (!isset($_GET['action'])){
    header('Location:index.php');
    exit;
}

require('models/Label.php');

if($_GET['action'] == 'list'){
	$labels = getAllLabels();
	require('views/labelList.php');
}
elseif($_GET['action'] == 'new'){
    $parentLabels = getAllLabels();
	require('views/labelForm.php');
}
elseif($_GET['action'] == 'add'){
	
	if(empty($_POST['name'])){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';
		}
		
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=labels&action=new');
		exit;
	}
	else{
		$resultAdd = addLabel($_POST);
		
		$_SESSION['messages'][] = $resultAdd ? 'Label enregistré !' : "Erreur lors de l'enregistreent du label... :(";
		
		header('Location:index.php?controller=labels&action=list');
		exit;
	}
}
elseif($_GET['action'] == 'edit'){

    if (!isset($_GET['id'])){
        header('Location:index.php?controller=labels&action=list');
        exit;
    }
    else{
        $labelExist = getLabel($_GET['id']);
        if (!$labelExist){
            header('Location:index.php?controller=labels&action=list');
            exit;
        }

    }
	
	if(!empty($_POST)){
        if(empty($_POST['name'])){

            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ nom est obligatoire !';
            }

            $_SESSION['old_inputs'] = $_POST;
            header('Location:index.php?controller=labels&action=new');
            exit;
        }
        else {
            $result = updateLabel($_GET['id'], $_POST);
            if ($result) {
                $_SESSION['messages'][] = 'Label mis à jour !';
            } else {
                $_SESSION['messages'][] = 'Erreur lors de la mise à jour... :(';
            }
            header('Location:index.php?controller=labels&action=list');
            exit;
        }
	}
	else{
		$label = getLabel($_GET['id']);
        $parentLabels = getAllLabels();
		require('views/labelForm.php');
	}

}
elseif($_GET['action'] == 'delete'){
	$result = deletLabel(   $_GET['id']    );
	if($result){
		$_SESSION['messages'][] = 'Label supprimé !';
	}
	else{
		$_SESSION['messages'][] = 'Erreur lors de la suppression... :(';
	}
	header('Location:index.php?controller=labels&action=list');
	exit;
}
else{
    header('Location:index.php');
    exit;
}

<?php

function getAllArtists()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM artists');
	$artists =  $query->fetchAll();

    return $artists;
}

function getArtist($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM artists WHERE id = ?");
	$query->execute([
		$id
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function updateArtist($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare('UPDATE artists SET name = ?, biography = ?, label_id = ? WHERE id = ?');
	
	$result = $query->execute(
		[
			$informations['name'],
			$informations['biography'],
			$informations['label'],
			$id,
		]
	);

	if ($_FILES['image']['name'] != ''){
        $artistUpdate = getArtist($id);
        $artistId = $artistUpdate['id'];
        $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
        $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);
        if (in_array($my_file_extension , $allowed_extensions)){
            $new_file_name = $artistId . '.' . $my_file_extension ;
            $destination = '../assets/images/artist/' . $new_file_name;
            $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

            $db->query("UPDATE artists SET image = '$new_file_name' WHERE id = $artistId");
        }
    }
	return $result;
}

function addArtist($informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("INSERT INTO artists (name, biography, label_id) VALUES( :name, :biography, :label_id)");
	$result = $query->execute([
		'name' => $informations['name'],
		'biography' => $informations['biography'],
		'label_id' => $informations['label'],
	]);

	if($result){
		$artistId = $db->lastInsertId();
		
		$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
		$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);
		if (in_array($my_file_extension , $allowed_extensions)){
			$new_file_name = $artistId . '.' . $my_file_extension ;
			$destination = '../assets/images/artist/' . $new_file_name;
			$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);
			
			$db->query("UPDATE artists SET image = '$new_file_name' WHERE id = $artistId");
		}
	}
	
	return $result;
}

function deleteArtist($id)
{
	$db = dbConnect();
	
	//ne pas oublier de supprimer le fichier lié s'il y en un
	//avec la fonction unlink de PHP
    $imageExist = getArtist($id);
    if($imageExist['image']){
        $delet_file_name = $imageExist['image'];
        $destination = '../assets/images/artist/' . $delet_file_name;
        unlink($destination);
    }
	
	$query = $db->prepare('DELETE FROM artists WHERE id = ?');
	$result = $query->execute([$id]);
	
	return $result;
}
<?php
 require_once 'include/DB_Funciones.php';
$db = new DB_Funciones();
  
// json response array
$response = array("error" => FALSE);
  
if (isset($_POST['id_user'])) {
	$id_user = $_POST['id_user'];
	
	// create a new group
	$groups = $db->getGroupsByUserId($id_user);
	if ($groups) {
		// group stored successfully
		$response["error"] = FALSE;
		$response["groups"] = $groups;
	} else {
		// group failed to store
		$response["error"] = TRUE;
		$response["error_msg"] = "¡Error inesperado al obtener grupos! ";
	}
	
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "¡Faltan parametros!";
}

echo json_encode($response);
 
?>
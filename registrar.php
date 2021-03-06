<!--
	Registra un usuario.
-->
<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	require_once 'include/DB_Funciones.php';
	$db = new DB_Funciones();

	// json response array
	$response = array("error" => FALSE);

	if (isset($_POST['name']) && isset($_POST['password'])
	&& isset($_POST['mail']) && isset($_POST['birthday'])) {
		$name = $_POST['name'];
		$password = $_POST['password'];
		$mail = $_POST['mail'];
		$birthday = $_POST['birthday'];

		if ($db->isUserExisted($mail, $name)) { // existe usuario?
			// user already existed
			$response["error"] = TRUE;
			$response["error_msg"] = "El usuario ya existe";
		} else {
			// create a new user
			$user = $db->storeUser($name, $password, $mail, $birthday);
			if ($user) {
				// user stored successfully
				$response["error"] = FALSE;

				$response["user"]["name"] = $user["name"];
				$response["user"]["mail"] = $user["mail"];
				$response["user"]["birthday"] = $user["birth_date"];
				$response["user"]["state"] = $user["state"];
				$response["user"]["id_user"] = $user["id_user"];
			} else {
				// user failed to store
				$response["error"] = TRUE;
				$response["error_msg"] = "¡Error inesperado!";
			}
		}

	} else {
		$response["error"] = TRUE;
		$response["error_msg"] = "¡Faltan parametros!";
	}

	echo json_encode($response);
 
?>

<?php // modele/modele.inc.php

// require("classes/CRMJures.class.php");
// require ("classes/MgrSessionExamen.class.php");


/**
 * Verifie que l'utlisateur est bien un admin
 * @param PDO Connexion a la BDD
 * @param string Utilisateur
 * @param string Mot de passe
 * @return bool Si connecté
 */
function getConnectAdmin($connect, $user, $pass): bool
{
	$sql = "SELECT identifiant, Mot_de_passe FROM Utilisateur WHERE TypeUtilisateur = \"Administrateur\"";
	$cursor = $connect->query($sql);
	$result = $cursor->fetchAll();

	foreach ($result as $line) {
		if ($line['identifiant'] == $user && $line['Mot_de_passe'] == $pass) {
			$_SESSION["role"] = "Admin";
			return true;
		}
	}
	return false;
}

/**
 * Verifie que l'utlisateur est bien un Formateur
 * @param PDO Connexion a la BDD
 * @param string Utilisateur
 * @param string Mot de passe
 * @return bool Si connecté
 */
function getConnectForm($connect, $user, $pass): bool
{
	$sql = "SELECT identifiant, Mot_de_passe FROM Utilisateur WHERE TypeUtilisateur = \"Formateur\"";
	$cursor = $connect->query($sql);
	$result = $cursor->fetchAll();

	foreach ($result as $line) {
		if ($line['identifiant'] == $user && $line['Mot_de_passe'] == $pass) {
			$_SESSION["role"] = "Formateur";
			return true;
		}
	}
	return false;
}

/**
 * Recupere la liste des formateurs
 * @param PDO Connexion a la BDD
 * @return string La liste de formateur
 */
function getListFormateur($connect): string
{
	$sql = "SELECT *
			from Formateur";
	$cursor = $connect->query($sql);
	$result = $cursor->fetchAll();

	$message = "";
	foreach ($result as $line) {
		$message .= "<tr><td>" . $line["Nom_du_formateur"] . " " .
			$line["Prenom_du_Formateur"] . "</td>" .
			"<td>
					<a href=\"index.php?action=InfoFormateur&id=" . $line["IDFormateur"] . "\"><i class=\"fas fa-info-circle\"></i></a>
				</td>
				<td>";

		$sql = "SELECT COUNT(*)
				from session_formation
				WHERE IDFormateur = " . $line['IDFormateur'];
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();

		if ($result[0][0] == 0 || $result[0][0] == NULL) {
			$message .= "<a href=\"index.php?action=DELFormateur&id=" . $line["IDFormateur"] . "\"><i class=\"fas fa-minus-circle bg-danger\"></i></a>";
		}
		$message .= "</td>";
	}
	return $message;
}

/**
 * Recupere le Formateur correspondant a l'ID
 * @param PDO Connexion a la BDD
 * @param int ID du formateur
 * @return array Formateur
 */
function getFormateurByID($connection, $id): array
{
	$sql = "SELECT *
			from Formateur
			WHERE IDFormateur = $id";
	$cursor = $connection->query($sql);
	$result = $cursor->fetch();

	return $result;
}

/**
 * Appelle la procedure de suppression de Formateur correspondant
 * @param PDO Connexion a la BDD
 * @param int ID du formateur
 * @return bool Si supprimer
 */

function delFormateur($connection, $id): bool
{
	try {
		$sql = "CALL prc_DEL_Formateur($id)";
		$connection->query($sql);
		return true;
	} catch (Exception $e) {
		echo 'Erreur SQL';
	}
}

/**
 * Recupere la liste de formation
 * @param PDO Connexion a la BDD
 * @return string La liste de formation
 */
function getListFormation($connect): string
{
	$sql = "SELECT *
			from Formation";
	$cursor = $connect->query($sql);
	$result = $cursor->fetchAll();

	$message = "";
	foreach ($result as $line) {
		$message .= "<tr><td>" . $line["Intitule_de_formation"] . "</td></tr>";
	}
	return $message;
}

/**
 * Appelle la procedure d'ajout de Formateur correspondant
 * @param PDO Connexion a la BDD
 * @param int ID du formateur
 * @return string
 */

function addFormateur($connect): string
{
	$sql = "SELECT *
			from coordonnees";
	$cursor = $connect->query($sql);
	$result = $cursor->fetchAll();
	foreach ($result as $line) {
		if ($line['Telephone'] == $_POST['Telephone']) {
			return "DoublonPhone";
		} else if ($line['Mail'] == $_POST['Mail']) {
			return "DoublonMail";
		}
	}
	try {
		if (is_numeric($_POST['CodePostal']) && strlen($_POST['CodePostal']) == 5) {
			$sql = "CALL prc_ADD_FORMATEUR(:nom,:prenom,:adr1,:adr2,:postal,:ville,:phone,:mail);";
			$result = $connect->prepare($sql);
			$result->execute(array(
				':nom' => strtoupper($_POST['Nom']), ':prenom' => $_POST['Prenom'], ':adr1' => $_POST['Adresse1'],
				':adr2' => $_POST['Adresse2'], ':postal' => $_POST['CodePostal'], ':ville' => $_POST['Ville'],
				':phone' => $_POST['Telephone'], ':mail' => $_POST['Mail']
			));
			return "Reussi";
		} else {

			return "Postal";
		}
	} catch (Exception $e) {
		echo 'Erreur de Requete SQL';
	}
}


/**
 * Recupere les informations du formateur correspondant
 * @param PDO Connexion a la base
 * @param int ID du formateur correspondant
 * @return array Info du formateur
 */
function getInfoFormateurByID($connect, $idForm): array
{
	$formateur = getFormateurByID($connect, $idForm);

	$sql = "SELECT *
			from coordonnees
			WHERE IDCoordonnee = " . $formateur['IDCoordonnee'];
	$cursor = $connect->query($sql);
	$result = $cursor->fetch();

	$info = array(
		"id" => $formateur['IDFormateur'],
		"nom" => $formateur['Nom_du_formateur'],
		"prenom" => $formateur['Prenom_du_Formateur'],
		"adr1" => $result['Adresse1'],
		"adr2" => $result['Adresse2'],
		"postal" => $result['Code_Postale'],
		"ville" => $result['Ville'],
		"phone" => $result['Telephone'],
		"mail" => $result['Mail']
	);

	return $info;
}

/**
 * Met a jour les informations du formateur
 * @param PDO Connexion a la base
 * @return string Erreur ou Reussi
 */

function updateInfoFormateur($connection): string
{
	try {
		$sql = "SELECT IDCoordonnee
			from formateur
			WHERE IDFormateur = " . $_POST['idForm'];
		$cursor = $connection->query($sql);
		$result = $cursor->fetch();

		$sql = "SELECT *
			from coordonnees";
		$cursor = $connection->query($sql);
		$result2 = $cursor->fetchAll();
		foreach ($result2 as $line) {
			if ($line['Telephone'] == $_POST['Telephone'] && $line['IDCoordonnee'] != $result['IDCoordonnee']) {
				return "DoublonPhone";
			}
			if ($line['Mail'] == $_POST['Mail'] && $line['IDCoordonnee'] != $result['IDCoordonnee']) {
				return "DoublonMail";
			}
		}

		if (is_numeric($_POST['CodePostal']) && strlen($_POST['CodePostal']) == 5) {
			$sql = "CALL prc_UPD_Formateur(:idform,:nom,:prenom,:adr1,:adr2,:postal,:ville,:phone,:mail)";
			$result = $connection->prepare($sql);
			$result->execute(array(
				':idform' => $_POST['idForm'], ':nom' => strtoupper($_POST['Nom']), ':prenom' => $_POST['Prenom'], ':adr1' => $_POST['Adresse1'],
				':adr2' => $_POST['Adresse2'], ':postal' => $_POST['CodePostal'], ':ville' => $_POST['Ville'],
				':phone' => $_POST['Telephone'], ':mail' => $_POST['Mail']
			));
			return "Reussi";
		} else {
			return "Postal";
		}
	} catch (Exception $e) {
		echo 'Erreur SQL';
	}
}

/**
 * Get the list of Session Formation which are active at the current date
 * and put them in option
 * @param $connect
 * @return $message
 */
function getListSessionFormation($connect): string
{
	//Intialisation
	$sql = "CALL prc_LST_listeSessionFormation();";
	$cursor = $connect->query($sql);
	$result = $cursor->fetchAll();
	$message =   "<option selected>Sélectionner une session</option><br>";
	// Traitement 
	foreach ($result as $line) {
		$id = $line['IDSessionFormation'];
		$intitule = $line['Intitule_de_formation'];
		// Put the results of request in a select list
		$message .= "<option value=" . $id . " name=" . $id . " >" . $intitule . $id
			. "</option><br/>";
	}
	// Return the select list
	return $message;
}


/**
 * add a Session of an examen.
 * @param $connect / connection with a DB 
 * @param $idSessionFormation
 * @param $dateSessionFormation
 * @return string message de retour
 */
function addExamen($connect, $idSessionFormation, $dateSessionFormation): string
{
	// We check if there is no error.
	try {
		// We call the class method of MgrSessionExamen class
		MgrSessionExamen::addExamen($connect, $idSessionFormation, $dateSessionFormation);
		$message = "L'ajout est réussis \n<br/>";
		return $message;
	} catch (Exception $e) // Display a message if there is an error.
	{
		$message = $e->getMessage() . "\n<br/>";
		$reg = "/^SQLSTATE\[45001].*/";
		if (preg_match("/^SQLSTATE\[45001].*/", $message) == 1) {
			$message =  "La date demandée ne correspond pas à la période de la session de formation";
		} else if (preg_match("/^SQLSTATE\[45002].*/", $message) == 1) {
			$message =  "Il ne peut y avoir deux examens le même jour pour une même formation";
		} else {
			// $message = "La base de donnée n'est pas disponible";
			$message = $e->getMessage();
		}
		return $message;
	}
}



function delExamen($connect, $idSessionExamen)
{
	// We check if there is no error.
	try {
		// We call the class method of MgrSessionExamen class
		MgrSessionExamen::delExamen($connect, $idSessionExamen);
		$message = "La supression a bien eu lieu\n<br/>";
		return $message;
	} catch (Exception $e) // Display a message if there is an error.
	{
		$message = $e;

		return $message;
	}
}
/**
 * Recupere la liste de formation
 * @param PDO Connexion a la BDD
 * @return string La liste de formation
 */
function showListSessionFormation($connect)
{

	$sql = "CALL prc_LST_listeSessionFormation();";
	$cursor = $connect->query($sql);
	$result = $cursor->fetchAll();
	$aResult = [];
	foreach ($result as $line) {
		$aResult[] = $line;
	}
	return $aResult;
}

<?php // modele/modele.inc.php
	
	// require("classes/CRMJures.class.php");
	// require ("classes/MgrSessionExamen.class.php");

	/**
	 * Get the list of examen in days after the current date
	 * @param $connect
	 * @return string $message
	 */
	function getListExam($connect)
	{
		// Get the list Examen from the MgrsessionExamen
		$array_of_result = MgrSessionExamen::getListExam($connect);
		$message="";
		// Begin the foreach loop on $array_of_result
		foreach($array_of_result as $line)
		{
			// Put the result in a html table
			$message.="<tr><td>".$line["Intitule_de_formation"].
				$line["IDSessionFormation"]."</td>";
			$message.="<td>".$line["DateSessionExam"]."</td>".
				"<td>
					<a href=\"\"><i class=\"fas fa-info-circle\"></i></a>
				</td>
				<td>
					<a href=\"\"><i class=\"fas fa-minus-circle bg-danger\">
					</i></a>
				
				</td>";
			
		}
		// return the table with reults	
		return $message;	
	}

	function getConnectAdmin($connect,$user,$pass) : bool
	{	
		$sql="SELECT identifiant, Mot_de_passe FROM utilisateur WHERE TypeUtilisateur = \"Administrateur\"";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		
		foreach($result as $line)
		{
			if($line['identifiant'] == $user && $line['Mot_de_passe'] == $pass)
			{
				$_SESSION["role"] = "Admin";
				return true;
			}
		}	
		return false;
	}

	function getConnectForm($connect,$user,$pass) : bool
	{	
		$sql="SELECT identifiant, Mot_de_passe FROM utilisateur WHERE TypeUtilisateur = \"Formateur\"";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		
		foreach($result as $line)
		{
			if($line['identifiant'] == $user && $line['Mot_de_passe'] == $pass)
			{
				$_SESSION["role"] = "Formateur";
				return true;
			}
		}	
		return false;
	}

	function getListFormateur($connect)
	{	
		$sql="SELECT *
			from Formateur";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		
		$message = "";
		foreach($result as $line)
		{
			$message.="<tr><td>".$line["Nom_du_formateur"]." ".
				$line["Prenom_du_Formateur"]."</td>".
				"<td>
					<a href=\"index.php?action=InfoFormateur&id=".$line["IDFormateur"]."\"><i class=\"fas fa-info-circle\"></i></a>
				</td>
				<td>";

			$sql="SELECT COUNT(*)
				from session_formation
				WHERE IDFormateur = " .$line['IDFormateur'];
			$cursor = $connect->query($sql); 
			$result = $cursor->fetchAll();

			if($result[0][0] == 0 || $result[0][0] == NULL)
			{
				$message.="<a href=\"index.php?action=DELFormateur&id=".$line["IDFormateur"]."\"><i class=\"fas fa-minus-circle bg-danger\"></i></a>";
			}
			$message.= "</td>";
			
		}
		return $message;
	}

	function getFormateurByID($connection, $id)
	{	
		$sql="SELECT *
			from Formateur
			WHERE IDFormateur = $id";
		$cursor = $connection->query($sql);
		$result = $cursor->fetch();

		return $result;
	}

	function delFormateur($connection, $id)
	{
		try
		{
			$sql="CALL prc_DEL_Formateur($id)";
			$connection->query($sql);
			return true;
		}
		catch (Exception $e)
		{
			echo 'Erreur SQL';
		}
	}

	function getListFormation($connect)
	{	
		$sql="SELECT *
			from Formation";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		
		$message = "";
		foreach($result as $line)
		{
			$message.="<tr><td>".$line["Intitule_de_formation"]."</td>".
				"<td>
					<a href=\"\"><i class=\"fas fa-info-circle\"></i></a>
				</td>
				<td>
					<a href=\"\"><i class=\"fas fa-minus-circle bg-danger\"></i></a>
				</td>";
			
		}
		return $message;
	}

	function addFormateur($connect)
	{
		$sql="SELECT *
			from coordonnees";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		foreach($result as $line)
		{
			if($line['Telephone'] == $_POST['Telephone'])
			{
				return "DoublonPhone";
			}
			if($line['Mail'] == $_POST['Mail'])
			{
				return "DoublonMail";
			}
		}
		try
		{
			if(is_numeric($_POST['CodePostal']) && strlen($_POST['CodePostal']) == 5)
			{
				$sql="CALL prc_ADD_FORMATEUR(:nom,:prenom,:adr1,:adr2,:postal,:ville,:phone,:mail);";
				$result = $connect->prepare($sql);
				$result->execute(array(':nom'=>strtoupper($_POST['Nom']),':prenom'=>$_POST['Prenom'],':adr1'=>$_POST['Adresse1'],
									':adr2'=>$_POST['Adresse2'],':postal'=>$_POST['CodePostal'],':ville'=>$_POST['Ville'],
									':phone'=>$_POST['Telephone'],':mail'=>$_POST['Mail']));
				return "Reussi";
			}
			else
			{
				return "Postal";
			}
		}
		catch(Exception $e)
		{
			echo 'Erreur de Requete SQL';
		}
	}

	function getInfoFormateurByID($connect, $idForm)
	{
		$formateur = getFormateurByID($connect,$idForm);

		$sql="SELECT *
			from coordonnees
			WHERE IDCoordonnee = ".$formateur['IDCoordonnee'];
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

	function updateInfoFormateur($connection) : string
	{
		try
		{
			$sql="SELECT IDCoordonnee
			from formateur
			WHERE IDFormateur = ".$_POST['idForm'];
			$cursor = $connection->query($sql);
			$result = $cursor->fetch();

			$sql="SELECT *
			from coordonnees";
			$cursor = $connection->query($sql);
			$result2 = $cursor->fetchAll();
			foreach($result2 as $line)
			{
				if($line['Telephone'] == $_POST['Telephone'] && $line['IDCoordonnee'] != $result['IDCoordonnee'])
				{
					return "DoublonPhone";
				}
				if($line['Mail'] == $_POST['Mail'] && $line['IDCoordonnee'] != $result['IDCoordonnee'])
				{
					return "DoublonMail";
				}	
			}

			if(is_numeric($_POST['CodePostal']) && strlen($_POST['CodePostal']) == 5)
			{
				$sql="CALL prc_UPD_Formateur(:idform,:nom,:prenom,:adr1,:adr2,:postal,:ville,:phone,:mail)";
				$result = $connection->prepare($sql);
				$result->execute(array(':idform'=>$_POST['idForm'],':nom'=>strtoupper($_POST['Nom']),':prenom'=>$_POST['Prenom'],':adr1'=>$_POST['Adresse1'],
									   ':adr2'=>$_POST['Adresse2'],':postal'=>$_POST['CodePostal'],':ville'=>$_POST['Ville'],
								   ':phone'=>$_POST['Telephone'],':mail'=>$_POST['Mail']));
				return "Reussi";
			}
			else
			{
				return "Postal";
			}
			
		}
		catch (Exception $e)
		{
			echo 'Erreur SQL';
		}
	}

	/**
	 * Get the list of Session Formation which are active at the current date
	 * @param $connect
	 * @return $message
	 */
        function getListSessionFormation($connect)
        {
			//Intialisation
			$sql="CALL prc_LST_listeSessionFormation();";
			$cursor = $connect->query($sql);
            $result = $cursor->fetchAll();
			$message=   "<option selected>Sélectionner une session</option><br>";
			// Traitement 
			foreach($result as $line)
			{	$id=$line['IDSessionFormation'];
				$intitule=$line['Intitule_de_formation'];
				// Put the results of request in a select list
				$message.="<option value=".$id." name=". $id." >".$intitule.$id
				."</option><br/>";

								
				
			}
			// Return the select list
			return $message;
		}
	/**
	 * add a Session of an examen.
	 * @param $connect / connection with a DB 
	 * @param $idSessionFormation
	 * @param $dateSessionFormation
	 */
        function addExamen($connect, $idSessionFormation, $dateSessionFormation)
		{
			// We check if there is no error.
			try{
				// We call the class method of MgrSessionExamen class
				MgrSessionExamen::addExamen($connect, $idSessionFormation,$dateSessionFormation);
				$message = "L'ajout est réussis \n<br/>";
				return $message;
				
			}catch(Exception $e) // Display a message if there is an error.
			{
				$message ="Il y eu un soucis : ".$e->getMessage()."\n<br/>"; 
				return $message;
			}
		}
?>
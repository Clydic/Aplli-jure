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
		$ursor = $connect->query($sql);
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
					<a href=\"\"><i class=\"fas fa-info-circle\"></i></a>
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
		$sql="CALL prc_DEL_Formateur($id)";
		$connection->query($sql);
		return true;
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

	function addFormateur($connect, $POST)
	{
		$sql="SELECT *
			from Formateur";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		foreach($result as $line)
		{
			if($line['Nom_du_formateur'] == $POST['Nom'] && $line["Prenom_du_Formateur"] == $POST['Prenom'])
			{
				return false;
			}
		}
		try
		{
			$sql="CALL prc_ADD_FORMATEUR(:nom,:prenom,:adr1,:adr2,:postal,:ville,:phone,:mail);";
			$result = $connect->prepare($sql);
        	$result->execute(array(':nom'=>$POST['Nom'],':prenom'=>$POST['Prenom'],':adr1'=>$POST['Adresse1'],
							   	':adr2'=>$POST['Adresse2'],':postal'=>$POST['CodePostale'],':ville'=>$POST['Ville'],
							   ':phone'=>$POST['Telephone'],':mail'=>$POST['Mail']));
			return true;
		}
		catch(Exception $e)
		{
			return 'Erreur de Requete SQL';
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

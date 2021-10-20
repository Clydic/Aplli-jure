<?php // modele/modele.inc.php
	
	// require("classes/CRMJures.class.php");
	require ("classes/MgrSessionExamen.class.php");

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
					<a href=\"\"><i class=\"fas fa-info-circle\"></i></a>
				</td>
				<td>
					<a href=\"\"><i class=\"fas fa-minus-circle bg-danger\">
					</i></a>
				
				</td>";
			
		}
		return $message;
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
		try
		{
			$sql="CALL prc_ADD_FORMATEUR(:nom,:prenom,:adr1,:adr2,:postal,:ville,:phone,:mail);";
			$result = $connect->prepare($sql);
        	$result->execute(array(':nom'=>$POST['Nom'],':prenom'=>$POST['Prenom'],':adr1'=>$POST['Adresse1'],
							   	':adr2'=>$POST['Adresse2'],':postal'=>$POST['CodePostale'],':ville'=>$POST['Ville'],
							   ':phone'=>$POST['Telephone'],':mail'=>$POST['Mail']));
			echo 'YOUPI';
		}
		catch(Exception $e)
		{
			echo "lol";
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
			$message.="<option value=".$id.">".$intitule.$id
			."</option><br/>";

							
			
		}
		// Return the select list
		return $message;	
	}
        
?>

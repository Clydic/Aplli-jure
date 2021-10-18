<?php // modele/modele.inc.php
	
	require("classes/CRMJure.class.php");


	function getConnectAdmin($connect,$user,$pass) : bool
	{	
		$sql="SELECT identifiant, Mot_de_passe FROM utilisateur WHERE TypeUtilisateur = \"Administrateur\"";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		
		foreach($result as $line)
		{
			if($line['identifiant'] == $user && $line['Mot_de_passe'] == $pass)
			{
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
?>

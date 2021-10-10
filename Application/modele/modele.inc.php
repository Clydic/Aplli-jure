<?php // modele/modele.inc.php
<<<<<<< HEAD
=======
	
	require("classes/CRMJure.class.php");
	$connection= CRMJures::getConnection();
	function getListExam($connect)
	{	
		$sql="SELECT f.Intitule_de_formation,
		       	s.IDSessionFormation, 
			e.DateSessionExam 
			from Formation f
			JOIN Session_Formation s on s.IDFormation = f.IDFormation
			JOIN SessionExamen e on e.IDSessionExam = s.IDSessionExam";
		$cursor = $connect->query($sql);
		$result = $cursor->fetchAll();
		
		return $result;	
	}
$affiche =getListExam($connection);
$message = ""
foreach($affiche as $line)
{
	$message.="<tr><td>".$line["Intitule_de_formation"].
		$line["IDSessionFormation"]."</td>";
	$message.="<td>".$line["DateSessionExam"]."</td>"
}
>>>>>>> Cedric
?>

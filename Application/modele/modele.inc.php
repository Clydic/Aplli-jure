<?php // modele/modele.inc.php
	
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
		
		$message = "";
		foreach($result as $line)
		{
			$message.="<tr><td>".$line["Intitule_de_formation"].
				$line["IDSessionFormation"]."</td>";
			$message.="<td>".$line["DateSessionExam"]."</td>".
				"<td>
					<input class=\"btn btn-sm btn-info \"
					type=\"button\" value=\"info\">

					<input class=\"btn btn-sm btn-danger \"
					type=\"button\" value=\"supprimer\">
				</td>";
			
		}
		return $message;	
	}
?>

<?php // index.php 
	require_once("modele/modele.inc.php");
	require_once("classes/MgrSessionExamen.php");
	require_once("classes/CRMJures.class.php");
	$action="listExam";
	$logo="source/index.jpg";
	$connection= CRMJures::getConnection();
	print_r($action);
	echo "Get : "; print_r($_GET);

	switch($action)
	{
		case 'accueil':

			break;
		case'listExam':
			$tabTitle="Gestion des sessions d'examen";
			$h1Title="Gestion des sessions d'examen";
			require("vues/view_header.php");			
			require("vues/view_navbar.php");			
			require("vues/view_list-exam.php");			
			require("vues/view_footer.php");
			break;			
	}


?>

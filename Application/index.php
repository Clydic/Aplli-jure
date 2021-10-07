<?php // index.php 
	$action="listExam";
	$logo="source/index.jpg";
	require("modele/modele.inc.php");
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

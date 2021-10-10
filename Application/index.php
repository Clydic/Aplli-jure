<?php // index.php 
	$action="accueil";
	$logo="source/index.png";
	require("modele/modele.inc.php");
	print_r($action);
	echo "Get : "; print_r($_GET);

	if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

	switch($action)
	{
		case 'accueil':
			$tabTitle="Accueil";
			$h1Title="Accueil";
			require("vues/view_header.php");				
			require("vues/view_accueil.php");			
			require("vues/view_footer.php");
			break;
		case 'connectAdmin':
			$tabTitle="Connexion Adminstrateur";
			$h1Title="Connexion";
			require("vues/view_header.php");				
			require("vues/view_connexionAdmin.php");			
			require("vues/view_footer.php");
			break;
		case 'connectForm':
			$tabTitle="Connexion Formateur";
			$h1Title="Connexion";
			require("vues/view_header.php");				
			require("vues/view_connexionForm.php");			
			require("vues/view_footer.php");
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

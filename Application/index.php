<?php // index.php 
	require_once("modele/modele.inc.php");
	require_once("classes/MgrSessionExamen.class.php");
	require_once("classes/CRMJure.class.php");
	$connection= CRMJures::getConnection();
	$action="accueil";//"accueil";
	$logo="source/index.png";
	$logoCRUDFormateur="source/CRUD_Formateur.png";
	$logoCRUDFormation="source/CRUD_Formation.png";
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
		case 'accueilAdmin':
			if(getConnectAdmin($connection,$_GET['user'],$_GET['password']) == true)
			{
				$tabTitle="Accueil Administrateur";
				$h1Title="Accueil";
				require("vues/view_header.php");
				require("vues/view_navbarAdmin.php");				
				require("vues/view_accueilAdmin.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php?action=connectAdmin');
			}
			break;
		case 'accueilForm':
			if(getConnectForm($connection,$_GET['user'],$_GET['password']) == true)
			{
				$tabTitle="Accueil Formateur";
				$h1Title="Accueil";
				require("vues/view_header.php");
				require("vues/view_navbar.php");				
				require("vues/view_accueilForm.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php?action=connectForm');
			}
			break;
		case 'CRUDFormation':
			$tabTitle="Gestion Formation";
			$h1Title="Gestion Formation";

			
			require("vues/view_header.php");
			require("vues/view_navbarAdmin.php");				
			require("vues/view_CRUDFormation.php");			
			require("vues/view_footer.php");
			break;
		case 'CRUDFormateur':
			$tabTitle="Gestion Formateur";
			$h1Title="Gestion Formateur";
			require("vues/view_header.php");
			require("vues/view_navbarAdmin.php");				
			require("vues/view_CRUDFormateur.php");			
			require("vues/view_footer.php");
			break;
		case'listExam':
			$tabTitle="Gestion des sessions d'examen";
			$h1Title="Gestion des sessions d'examen";
			$listExamen = MgrSessionExamen::getListExam($connection);
			require("vues/view_header.php");			
			require("vues/view_navbar.php");
			require("vues/view_list-exam.php");			
			require("vues/view_footer.php");
			break;			
	}


?>

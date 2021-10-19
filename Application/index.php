<?php // index.php 
	require_once("modele/modele.inc.php");
	require_once("classes/MgrSessionExamen.class.php");
	require_once("classes/CRMJure.class.php");
	$connection= CRMJures::getConnection();
	$action="accueil";//"accueil";
	$connect=NULL;
	$logo="source/index.png";
	print_r($action);
	echo "Get : "; print_r($_GET);

	if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

	if (isset($_GET['connect'])) {
        $connect = $_GET['connect'];
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
			if($connect == false)
			{
				echo "<script>alert(\"Utilisateur ou Mot de passe incorrect\");</script>";
			}
			require("vues/view_header.php");				
			require("vues/view_connexionAdmin.php");			
			require("vues/view_footer.php");
			break;
		case 'connectForm':
			$tabTitle="Connexion Formateur";
			$h1Title="Connexion";
			if($connect == false)
			{
				echo "<script>alert(\"Utilisateur ou Mot de passe incorrect\");</script>";
			}
			require("vues/view_header.php");				
			require("vues/view_connexionForm.php");			
			require("vues/view_footer.php");
			break;		
		case 'accueilAdmin':
			if(getConnectAdmin($connection,$_GET['user'],$_GET['password']) == true)
			{
				$tabTitle="Accueil Administrateur";
				$h1Title="Accueil";
				$logoCRUDFormateur="source/CRUD_Formateur.png";
				$logoCRUDFormation="source/CRUD_Formation.png";
				require("vues/view_header.php");
				require("vues/view_navbarAdmin.php");				
				require("vues/view_accueilAdmin.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php?action=connectAdmin&connect=false');
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
				header('Location: index.php?action=connectForm&connect=false');
			}
			break;
		case 'CRUDFormation':
			$tabTitle="Gestion Formation";
			$h1Title="Gestion Formation";
			$listFormation = getListFormation($connection);
			require("vues/view_header.php");
			require("vues/view_navbarAdmin.php");				
			require("vues/view_CRUDFormation.php");			
			require("vues/view_footer.php");
			break;
		case 'CRUDFormateur':
			$tabTitle="Gestion Formateur";
			$h1Title="Gestion Formateur";
			$listFormateur = getListFormateur($connection);
			require("vues/view_header.php");
			require("vues/view_navbarAdmin.php");				
			require("vues/view_CRUDFormateur.php");			
			require("vues/view_footer.php");
			break;

		case 'AjoutFormateur':
			$tabTitle="Gestion Formateur";
			$h1Title="Gestion Formateur";
			require("vues/view_header.php");		
			require("vues/view_AjoutFormateur.php");			
			require("vues/view_footer.php");
			break;

		case'listExam':
			$tabTitle="Gestion des sessions d'examen";
			$h1Title="Gestion des sessions d'examen";
			$listExamen = getListExam($connection);
			require("vues/view_header.php");			
			require("vues/view_navbar.php");
			require("vues/view_list-exam.php");			
			require("vues/view_footer.php");
			break;			
	}


?>

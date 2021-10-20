<?php // index.php 
	require("modele/modele.inc.php");
	require("classes/MgrSessionExamen.class.php");
	require("classes/CRMJures.class.php");
	session_start();
	$connection= CRMJures::getConnection();
	$action="accueil";//"accueil";
	$connect = NULL;
	$logo="source/index.png";
	print_r($action);
	echo " Get : "; print_r($_GET);

	if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

	if (isset($_POST['action'])) {
        $action = $_POST['action'];
    }

	if (isset($_GET['connect'])) {
        $connect = $_GET['connect'];
    }

	if (isset($_SESSION["role"])) {
        var_dump($_SESSION["role"]);
    }

	switch($action)
	{
		case 'accueil':
			$_SESSION["role"] = "";
			$tabTitle="Accueil";
			$h1Title="Accueil";
			require("vues/view_header.php");				
			require("vues/view_accueil.php");			
			require("vues/view_footer.php");
			break;
		case 'connectAdmin':
			$tabTitle="Connexion Adminstrateur";
			$h1Title="Connexion";
			if($connect == "NON")
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
			if($connect == "NON")
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
				header('Location: index.php?action=connectAdmin&connect=NON');
			}
			break;
		
		case 'CRUDFormation':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
				$tabTitle="Gestion Formation";
				$h1Title="Gestion Formation";
				$listFormation = getListFormation($connection);
				require("vues/view_header.php");
				require("vues/view_navbarAdmin.php");				
				require("vues/view_CRUDFormation.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php');
			}
			
			break;
		case 'CRUDFormateur':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
				$tabTitle="Gestion Formateur";
				$h1Title="Gestion Formateur";
				$listFormateur = getListFormateur($connection);
				require("vues/view_header.php");
				require("vues/view_navbarAdmin.php");				
				require("vues/view_CRUDFormateur.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php');
			}
			
			break;
		case 'FctAjoutFormateur':
			if(addFormateur($connection, $_POST))
			{
				$tabTitle="Ajout Formateur";
				$h1Title="Gestion Formateur";
				require("vues/view_header.php");		
				require("vues/view_AjoutReussi.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php?action=AjoutFormateur&msg=doublon');
			}
			break;

		case 'AjoutFormateur':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
				
				$tabTitle="Gestion Formateur";
				$h1Title="Gestion Formateur";
				require("vues/view_header.php");		
				require("vues/view_AjoutFormateur.php");			
				require("vues/view_footer.php");
				if(isset($_GET['msg']) && $_GET['msg'] == "doublon")
				{
					echo "<script>alert(\"Formateur en doublon...\");</script>";
				}
			}
			else
			{
				header('Location: index.php');
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
				header('Location: index.php?action=connectForm&connect=NON');
			}
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

		case'ajoutExamen':
			$tabTitle="Gestion des sessions d'examen";
			$h1Title="Ajouter une session d'examen";
			$date= "25/06/2021";
			$list_formation = getListSessionFormation($connection);
			require("vues/view_header.php");			
			require("vues/view_navbar.php");
			require("vues/view_ajout_session_examen.php");			
			require("vues/view_footer.php");
			break;			
	}


?>

<?php // index.php 
	require("modele/modele.inc.php");
	require("classes/MgrSessionExamen.class.php");
	require("classes/CRMJures.class.php");
	session_start();
	$connection= CRMJures::getConnection();
	$action="accueil";//"accueil";
	$isConnect = NULL; // Variable pour savoir si l'utilisateur est connecté 
	$message = ""; // Varibales des messages d'inforamtion de crud
	$href=""; // Variable pour modifier certain lien hypertexte
	$textLink=""; // Le text des liens hyper texte	
	$logo="source/index.png";
	print_r($action);
	echo " Get : "; print_r($_GET);
	echo " \nPOST : "; print_r($_POST);
	echo " \nSession : "; print_r($_SESSION);

	if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

	if (isset($_POST['action'])) {
        $action = $_POST['action'];
    }

	if (isset($_GET['isConnect'])) {
        $isConnect = $_GET['isConnect'];
    }

	if (isset($_SESSION["role"])) {
        print_r( "role : ");var_dump($_SESSION["role"]);
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
			if($isConnect == "NON")
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
			if($isConnect == "NON")
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
				header('Location: index.php?action=connectAdmin&isConnect=NON');
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

		case 'AjoutFormateur':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
				
				$tabTitle="Gestion Formateur";
				$h1Title="Gestion Formateur";

				require("vues/view_header.php");		
				require("vues/view_AjoutFormateur.php");			
				require("vues/view_footer.php");
				if(isset($_GET['msg']) && $_GET['msg'] == "ErreurPostal")
					{
						echo "<script>alert(\"Echec d'ajout : Le code postal est invalide\");</script>";
					}
					if(isset($_GET['msg']) && $_GET['msg'] == "Doublon")
					{
						echo "<script>alert(\"Echec d'ajout : Le formateur est en doublon\");</script>";
					}
			}
			else
			{
				header('Location: index.php');
			}
			break;

		case 'FctAjoutFormateur':
			$reponseAjout = "";
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
				$reponseAjout = addFormateur($connection);
				
				if($reponseAjout == "Reussi")
				{
					$tabTitle="Gestion Formateur";
					$h1Title="Gestion Formateur";
					$message = 'Ajout Reussi !';
					$textLink = "Retour a la liste de formateur";
					$href = 'index.php?action=CRUDFormateur';
					require("vues/view_header.php");		
					require("vues/view_Reussi.php");			
					require("vues/view_footer.php");
				}
				elseif ($reponseAjout == "Doublon")
				{
					header('Location: index.php?action=AjoutFormateur&msg=Doublon');
				}
				elseif ($reponseAjout == "Postal")
				{
					header('Location: index.php?action=AjoutFormateur&msg=ErreurPostal');
				}
			}
			else
			{
				header('Location: index.php');
			}
			break;

		case 'DELFormateur':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
					
				$tabTitle="Gestion Formateur";
				$h1Title="Gestion Formateur";
				$FormSupp = getFormateurByID($connection, $_GET['id']);
				require("vues/view_header.php");		
				require("vues/view_DELFormateur.php");			
				require("vues/view_footer.php");
				if(isset($_GET['msg']) && $_GET['msg'] == "Erreur")
				{
					echo "<script>alert(\"Echec de suppression\");</script>";
				}
			}
			else
			{
				header('Location: index.php');
			}
			break;

		case 'FctDELFormateur':
			$reponseDelete = "";
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
				$reponseDelete = delFormateur($connection, $_GET['idForm']);
				
				if($reponseDelete)
				{
					$tabTitle="Gestion Formateur";
					$h1Title="Gestion Formateur";
					$message = 'Suppression Reussi !';
					$textLink = "Retour a la liste de formateur";
					$href = 'index.php?action=CRUDFormateur';
					require("vues/view_header.php");		
					require("vues/view_Reussi.php");			
					require("vues/view_footer.php");
				}
				else
				{
					header('Location: index.php?action=DELFormateur&idForm='.$_POST['idForm'].'&msg=Erreur');
				}
			}
			else
			{
				header('Location: index.php');
			}
			break;

		case 'InfoFormateur':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
					
				$tabTitle="Gestion Formateur";
				$h1Title="Gestion Formateur";
				$info = getInfoFormateurByID($connection, $_GET['id']);
				require("vues/view_header.php");		
				require("vues/view_InfoFormateur.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php');
			}
			break;

		case 'ModifierFormateur':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
					
				$tabTitle="Gestion Formateur";
				$h1Title="Gestion Formateur";
				$info = getInfoFormateurByID($connection, $_GET['idForm']);
				require("vues/view_header.php");		
				require("vues/view_ModifierFormateur.php");			
				require("vues/view_footer.php");
				if(isset($_GET['msg']) && $_GET['msg'] == "ErreurPostal")
				{
					echo "<script>alert(\"Echec de modification : Le code postal est invalide\");</script>";
				}
				if(isset($_GET['msg']) && $_GET['msg'] == "Doublon")
				{
					echo "<script>alert(\"Echec de modification : Le formateur est en doublon\");</script>";
				}
			}
			else
			{
				header('Location: index.php');
			}
			break;

		case 'FctModifierFormateur':
			$reponseUpdate = "";
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin")
			{
				$reponseUpdate = updateInfoFormateur($connection);
				var_dump($reponseUpdate);
				
				if($reponseUpdate == "Reussi")
				{
					$tabTitle="Gestion Formateur";
					$h1Title="Gestion Formateur";
					$message = 'Update Reussi !';
					$textLink = "Retour a la liste de formateur";
					$href = 'index.php?action=CRUDFormateur';
					require("vues/view_header.php");		
					require("vues/view_Reussi.php");			
					require("vues/view_footer.php");
				}
				elseif ($reponseUpdate == "Doublon")
				{
					header('Location: index.php?action=ModifierFormateur&idForm='.$_POST['idForm'].'&msg=Doublon');
				}
				elseif ($reponseUpdate == "Postal")
				{
					header('Location: index.php?action=ModifierFormateur&idForm='.$_POST['idForm'].'&msg=ErreurPostal');
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
				echo "Je suis dans le case accueilForm";
				require("vues/view_header.php");
				require("vues/view_navbar.php");				
				require("vues/view_accueilForm.php");			
				require("vues/view_footer.php");
			}
			else
			{
				header('Location: index.php?action=connectForm&isConnect=NON');
			}
			break;
			
		case 'listExam':
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "Formateur")
			{
				$tabTitle="Gestion des sessions d'examen";
				$h1Title="Gestion des sessions d'examen";
				$listExamen = getListExam($connection);
				require("vues/view_header.php");			
				require("vues/view_navbar.php");
				require("vues/view_list-exam.php");			
				require("vues/view_footer.php");
				break;
			}
			else
			{
				header('Location : index.php');
			}

		case'ajoutExamen':
			if(isset($_session["role"]) && $_session["role"]=="Formateur")
			{
				$tabTitle="Gestion des sessions d'examen";
				$h1Title="Ajouter une session d'examen";
				$list_formation = getListSessionFormation($connection);
				require("vues/view_header.php");			
				require("vues/view_navbar.php");
				require("vues/view_ajout_session_examen.php");			
				require("vues/view_footer.php");
				break;			
			}
			else
			{			
				header('Location: index.php');
			}
		
			case 'ajoutExamenEffectue':
				$message = addExamen($connection,$_GET['IdSessionFormation'] ,$_GET['date']);
				$tabTitle="Ajout Session examen";
				$h1Title="Gestion Session Examen";
				$href = "index.php?action=listExam";
				$textLink ="Retour à la liste des examens";
				
				require("vues/view_header.php");		
				require("vues/view_Reussi.php");			
				require("vues/view_footer.php");
				break;
			case 'confirmationSuppressionExamen':
				$tabTitle="Suppression d'une Session examen";
				$h1Title="Gestion Session Examen";
				
				require("vues/view_header.php");		
				require("vues/view_comfirmation_suppression_examen.php");			
				require("vues/view_footer.php");

				break;



			case 'suppressionExamenEffectue':
				$message = delExamen($connection,$_GET['IDSessionExam']);
				$tabTitle="Ajout Session examen";
				$h1Title="Gestion Session Examen";
				$href = "index.php?action=listExam";
				$textLink ="Retour à la liste des examens";
				
				require("vues/view_header.php");		
				require("vues/view_Reussi.php");			
				require("vues/view_footer.php");
				break;
	}
	


?>

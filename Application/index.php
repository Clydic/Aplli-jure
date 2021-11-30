<?php // index.php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL); 

require("modele/modele.inc.php");
require("classes/MgrSessionExamen.class.php");
require("classes/CRMJures.class.php");
session_start();
$connection = CRMJures::getConnection();
$action = "accueil"; //"accueil";
$isConnect = NULL; // Variable pour savoir si l'utilisateur est connecté 
$message = ""; // Variables des messages d'information de crud
$href = ""; // Variable pour modifier certain lien hypertexte
$textLink = ""; // Le text des liens hyper texte	
$logo = "source/index.png";

if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

if (isset($_POST['action'])) {
	$action = $_POST['action'];
}

if (isset($_GET['isConnect'])) {
	$isConnect = $_GET['isConnect'];
}


switch ($action) {
	case 'accueil':
		$_SESSION["role"] = "";
		$tabTitle = "Accueil";
		$h1Title = "Accueil";
		require("vues/view_header.php");
		require("vues/view_accueil.php");
		require("vues/view_footer.php");
		break;

	case 'connectAdmin':
		$tabTitle = "Connexion Adminstrateur";
		$h1Title = "Connexion";
		if ($isConnect == "NON") {
			echo "<script>alert(\"Utilisateur ou Mot de passe incorrect\");</script>";
		}
		require("vues/view_header.php");
		require("vues/view_connexionAdmin.php");
		require("vues/view_footer.php");
		break;

	case 'connectForm':
		$tabTitle = "Connexion Formateur";
		$h1Title = "Connexion";
		if ($isConnect == "NON") {
			echo "<script>alert(\"Utilisateur ou Mot de passe incorrect\");</script>";
		}
		require("vues/view_header.php");
		require("vues/view_connexionForm.php");
		require("vues/view_footer.php");
		break;

	case 'accueilAdmin':
		if (isset($_POST['user']) && isset($_POST['password'])) {
			$_SESSION["user"] = $_POST['user'];
			$_SESSION["password"] = $_POST['password'];
			unset($_POST['user']);
			unset($_POST['password']);
			if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
				header('Location: index.php?action=accueilAdmin');
			}
		} else {
			if (getConnectAdmin($connection, $_SESSION['user'], $_SESSION['password']) == true) {
				$tabTitle = "Accueil Administrateur";
				$h1Title = "Accueil";
				$logoCRUDFormateur = "source/CRUD_Formateur.png";
				$logoCRUDFormation = "source/CRUD_Formation.png";
				require("vues/view_header.php");
				require("vues/view_navbarAdmin.php");
				require("vues/view_accueilAdmin.php");
				require("vues/view_footer.php");
			} else {
				header('Location: index.php?action=connectAdmin&isConnect=NON');
			}
		}

		break;

	case 'CRUDFormation':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {
			$tabTitle = "Gestion Formation";
			$h1Title = "Gestion Formation";
			$listFormation = getListFormation($connection);
			require("vues/view_header.php");
			require("vues/view_navbarAdmin.php");
			require("vues/view_CRUDFormation.php");
			require("vues/view_footer.php");
		} else {
			header('Location: index.php');
		}

		break;

	case 'CRUDFormateur':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {
			$tabTitle = "Gestion Formateur";
			$h1Title = "Gestion Formateur";
			$listFormateur = getListFormateur($connection);
			require("vues/view_header.php");
			require("vues/view_navbarAdmin.php");
			require("vues/view_CRUDFormateur.php");
			require("vues/view_footer.php");
		} else {
			header('Location: index.php');
		}

		break;

	case 'AjoutFormateur':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {

			$tabTitle = "Gestion Formateur";
			$h1Title = "Gestion Formateur";

			require("vues/view_header.php");
			require("vues/view_AjoutFormateur.php");
			require("vues/view_footer.php");
			if (isset($_GET['msg']) && $_GET['msg'] == "ErreurPostal") {
				echo "<script>alert(\"Echec d'ajout : Le code postal est invalide\");</script>";
			}
			if (isset($_GET['msg']) && $_GET['msg'] == "DoublonMail") {
				echo "<script>alert(\"Echec d'ajout : Le mail est en doublon\");</script>";
			}
			if (isset($_GET['msg']) && $_GET['msg'] == "DoublonPhone") {
				echo "<script>alert(\"Echec d'ajout : Le téléphone est en doublon\");</script>";
			}
		} else {
			header('Location: index.php');
		}
		break;

	case 'FctAjoutFormateur':
		$reponseAjout = "";
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {
			$reponseAjout = addFormateur($connection);

			if ($reponseAjout == "Reussi") {
				$tabTitle = "Gestion Formateur";
				$h1Title = "Gestion Formateur";
				$message = 'Ajout Reussi !';
				$textLink = "Retour a la liste de formateur";
				$href = 'index.php?action=CRUDFormateur';
				require("vues/view_header.php");
				require("vues/view_Reussi.php");
				require("vues/view_footer.php");
			} elseif ($reponseAjout == "DoublonMail") {
				header('Location: index.php?action=AjoutFormateur&msg=DoublonMail');
			} elseif ($reponseAjout == "Postal") {
				header('Location: index.php?action=AjoutFormateur&msg=ErreurPostal');
			} elseif ($reponseAjout == "DoublonPhone") {
				header('Location: index.php?action=AjoutFormateur&msg=DoublonPhone');
			}
		} else {
			header('Location: index.php');
		}
		break;

	case 'DELFormateur':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {

			$tabTitle = "Gestion Formateur";
			$h1Title = "Gestion Formateur";
			$FormSupp = getFormateurByID($connection, $_GET['id']);
			require("vues/view_header.php");
			require("vues/view_DELFormateur.php");
			require("vues/view_footer.php");
			if (isset($_GET['msg']) && $_GET['msg'] == "Erreur") {
				echo "<script>alert(\"Echec de suppression\");</script>";
			}
		} else {
			header('Location: index.php');
		}
		break;

	case 'FctDELFormateur':
		$reponseDelete = "";
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {
			$reponseDelete = delFormateur($connection, $_GET['idForm']);

			if ($reponseDelete) {
				$tabTitle = "Gestion Formateur";
				$h1Title = "Gestion Formateur";
				$message = 'Suppression Reussi !';
				$textLink = "Retour a la liste de formateur";
				$href = 'index.php?action=CRUDFormateur';
				require("vues/view_header.php");
				require("vues/view_Reussi.php");
				require("vues/view_footer.php");
			} else {
				header('Location: index.php?action=DELFormateur&idForm=' . $_POST['idForm'] . '&msg=Erreur');
			}
		} else {
			header('Location: index.php');
		}
		break;

	case 'InfoFormateur':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {

			$tabTitle = "Gestion Formateur";
			$h1Title = "Gestion Formateur";
			$info = getInfoFormateurByID($connection, $_GET['id']);
			require("vues/view_header.php");
			require("vues/view_InfoFormateur.php");
			require("vues/view_footer.php");
		} else {
			header('Location: index.php');
		}
		break;

	case 'ModifierFormateur':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {

			$tabTitle = "Gestion Formateur";
			$h1Title = "Gestion Formateur";
			$info = getInfoFormateurByID($connection, $_GET['idForm']);
			require("vues/view_header.php");
			require("vues/view_ModifierFormateur.php");
			require("vues/view_footer.php");
			if (isset($_GET['msg']) && $_GET['msg'] == "ErreurPostal") {
				echo "<script>alert(\"Echec de modification : Le code postal est invalide\");</script>";
			}
			if (isset($_GET['msg']) && $_GET['msg'] == "DoublonMail") {
				echo "<script>alert(\"Echec de modification : Le mail est en doublon\");</script>";
			}
			if (isset($_GET['msg']) && $_GET['msg'] == "DoublonPhone") {
				echo "<script>alert(\"Echec de modification : Le téléphone est en doublon\");</script>";
			}
		} else {
			header('Location: index.php');
		}
		break;

	case 'FctModifierFormateur':
		$reponseUpdate = "";
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {
			$reponseUpdate = updateInfoFormateur($connection);

			if ($reponseUpdate == "Reussi") {
				$tabTitle = "Gestion Formateur";
				$h1Title = "Gestion Formateur";
				$message = 'Update Reussi !';
				$textLink = "Retour a la liste de formateur";
				$href = 'index.php?action=CRUDFormateur';
				require("vues/view_header.php");
				require("vues/view_Reussi.php");
				require("vues/view_footer.php");
			} elseif ($reponseUpdate == "DoublonMail") {
				header('Location: index.php?action=ModifierFormateur&idForm=' . $_POST['idForm'] . '&msg=DoublonMail');
			} elseif ($reponseUpdate == "Postal") {
				header('Location: index.php?action=ModifierFormateur&idForm=' . $_POST['idForm'] . '&msg=ErreurPostal');
			} elseif ($reponseUpdate == "DoublonPhone") {
				header('Location: index.php?action=ModifierFormateur&idForm=' . $_POST['idForm'] . '&msg=DoublonPhone');
			}
		} else {
			header('Location: index.php');
		}
		break;

	case 'accueilForm':
		if (isset($_POST['user']) && isset($_POST['password'])) {
			$_SESSION["user"] = $_POST['user'];
			$_SESSION["password"] = $_POST['password'];
			unset($_POST['user']);
			unset($_POST['password']);
			if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
				header('Location: index.php?action=accueilForm');
			}
		} else {
			if (getConnectForm($connection, $_SESSION['user'], $_SESSION['password']) == true) {
				$tabTitle = "Accueil Formateur";
				$h1Title = "Accueil";
				echo "Je suis dans le case accueilForm";
				require("vues/view_header.php");
				require("vues/view_navbar.php");
				require("vues/view_accueilForm.php");
				require("vues/view_footer.php");
			} else {
				header('Location: index.php?action=connectForm&isConnect=NON');
			}
		}
		break;
	case 'listExam':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Formateur") {
			$tabTitle = "Gestion des sessions d'examen";
			$h1Title = "Gestion des sessions d'examen";
			$listExamen = MgrSessionExamen::getListExam($connection);
			require("vues/view_header.php");
			require("vues/view_navbar.php");
			require("vues/view_list-exam.php");
			require("vues/view_footer.php");
			break;
		} else {
			header('Location : index.php');
		}

	case 'ajoutExamen':
		if (isset($_SESSION["role"]) && $_SESSION["role"] == "Formateur") {
			$tabTitle = "Gestion des sessions d'examen";
			$h1Title = "Ajouter une session d'examen";
			$list_formation = getListSessionFormation($connection);
			require("vues/view_header.php");
			require("vues/view_navbar.php");
			require("vues/view_ajout_session_examen.php");
			require("vues/view_footer.php");
			break;
		} else {
			header('Location: index.php');
		}

	case 'ajoutExamenEffectue':
		$message = addExamen($connection, $_GET['IdSessionFormation'], $_GET['date']);
		$tabTitle = "Ajout Session examen";
		$h1Title = "Gestion Session Examen";
		$href = "index.php?action=listExam";
		$textLink = "Retour à la liste des examens";

		require("vues/view_header.php");
		require("vues/view_Reussi.php");
		require("vues/view_footer.php");
		break;
	case 'confirmationSuppressionExamen':
		$tabTitle = "Suppression d'une Session examen";
		$h1Title = "Gestion Session Examen";

		require("vues/view_header.php");
		require("vues/view_comfirmation_suppression_examen.php");
		require("vues/view_footer.php");

		break;



	case 'suppressionExamenEffectue':
		$message = delExamen($connection, $_GET['IDSessionExam']);
		$tabTitle = "Ajout Session examen";
		$h1Title = "Gestion Session Examen";
		$href = "index.php?action=listExam";
		$textLink = "Retour à la liste des examens";

		require("vues/view_header.php");
		require("vues/view_Reussi.php");
		require("vues/view_footer.php");
		break;

	case 'page_indisponible':

		$tabTitle = "Page indisponible";
		$h1Title = "Page indisponible";
		$message = "Cette page est actuellement en construction et sera disponible ultérieurement nous vous remercions de votre patience";
		require("vues/view_header.php");
		require("vues/view_redirected.php");
		require("vues/view_footer.php");
}

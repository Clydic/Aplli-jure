<!--vues/view_header.php-->
<!DOCTYPE html>

<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="assets/CSS/theme/Minty.css">
	<link rel="stylesheet" href="assets/CSS/style.css">
	<title><?php echo $tabTitle; ?>  </title>
</head>
<body class="bg-primary">
	<header class="d-flex  bg-light mb-1 border border-3">
		<img class=" img-fluid w-50 h-50" src="<?php echo $logo; ?>" alt="Le logo de l'AFPA">
		<h1 class="  m-auto w-75 text-center"><?php echo $h1Title; ?> </h1>
	</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Session de formation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Archives</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Liste des jurés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Gestion de formation</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

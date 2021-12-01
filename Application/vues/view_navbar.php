<!--vues/view_navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Menu</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse " id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link " aria-curent="page" href="index.php?action=accueilForm">
						Accueil du formateur
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " aria-curent="page" href="index.php?action=listSessionFormation">
						Session de formation
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?action=page_indisponible">Archives</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?action=page_indisponible">Liste des jurés</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="index.php?action=listExam">Gestion des sessions d'examen</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?action=accueil">Déconnexion</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
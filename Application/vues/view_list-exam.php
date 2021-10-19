<!--vues/view_list-exam.php-->
	<main class=" bg-light  pt-2 mt-3">
		<h2 class=" text-center">Liste des sessions d'examen</h2>
		<div class="overflow-auto h-50">

			<table class=" container col-12  mt-5  
			fs-4 table table-striped table-dark mb-3">
<?php echo $listExamen;?>
			</table>
		</div>
		<div class="d-flex jusitfy-content-center mt-1">

			<a class="btn btn-info m-auto" href="index.php?action='ajoutExamen" role="button">Ajouter</a>
		</div>	
	</main>


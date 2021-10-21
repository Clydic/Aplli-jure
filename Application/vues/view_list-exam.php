<!--vues/view_list-exam.php-->
	<main class=" bg-light  pb-5 mt-3">
		<h2 class=" text-center">Liste des sessions d'examen</h2>
		<div class="overflow-auto h-50 p-3">

			<table class=" container col-12  mt-5  
			fs-4 table table-striped table-dark mb-3">
<?php echo $listExamen;?>
			</table>
		</div>
		<div class="d-flex justify-content-center mt-1">

			<a class="btn btn-info m-auto mt-3" href="index.php?action=ajoutExamen">Ajouter</a>
		</div>	
	</main>


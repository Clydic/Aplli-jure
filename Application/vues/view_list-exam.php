<!--vues/view_list-exam.php-->
<main class=" bg-light  pb-5 mt-3">
	<h2 class=" text-center">Liste des sessions d'examen à venir</h2>
	<div class="container overflow-auto h-25 p-3">

		<table class=" container col-12  mt-5 my-3  
			fs-4 table table-striped table-dark mb-3">
			<thead>
				<tr>
					<td>Intitulé de le session de formation</td>
					<td>Date d'examen</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($listExamen as $line) :
					// Put the result in a html table
					$idSessionFormation = $line->getIdSessionFormation();
					$idSessionExamen = $line->getIdExamen();
					$dateFormation = $line->getDateExamen();
					$intituleFormation = $line->getIntituleFormation();
				?>
					<tr>
						<td>
							<?php echo $intituleFormation . $idSessionFormation; ?>
						</td>

						<td> <?php echo $dateFormation ?>
						<td>

							<!-- <td>
					<a href=""><i class="fas fa-info-circle"></i></a>
				</td>-->

						<td>
							<a href="index.php?action=confirmationSuppressionExamen
						&IDSessionExam='<?php echo $idSessionExamen ?>'
						&date=' <?php echo $dateFormation  ?>' ">

								<i class="fas fa-minus-circle bg-danger"></i>
							</a>
						</td>



						<td>



						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>
	</div>
	<div class="d-flex justify-content-center mt-1">

		<a class="btn btn-info m-auto mt-3" href="index.php?action=ajoutExamen">Ajouter</a>
	</div>
</main>
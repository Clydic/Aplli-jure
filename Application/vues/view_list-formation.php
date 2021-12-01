<!--vues/view_list-exam.php-->
<main class=" bg-light  pb-5 mt-3">
	<h2 class=" text-center"><?php $h2Title ?></h2>
	<div class="overflow-auto h-50 p-3">

		<table class=" container col-12  mt-5  
			fs-4 table table-striped table-dark mb-3">
			<thead>
				<tr>
					<?php foreach ($listTd as $td) : ?>
						<td> <?php echo $td; ?></td>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($listSessionFormation as $line) :
					// Put the result in a html table
					$idSessionFormation = $line['IDSessionFormation'];
					$intituleFormation = $line['Intitule_de_formation'];
					$dateBeginFormation = $line['DateDebutFormation'];
					$dateEndFormation = $line['DateFinFormation'];
				?>
					<tr>
						<td>
							<?php echo $intituleFormation . $idSessionFormation; ?>
						</td>

						<td>
							<?php echo $dateBeginFormation ?>
						</td>
						<td>
							<?php echo $dateEndFormation ?>
						</td>

						<!-- <td>
					<a href=""><i class="fas fa-info-circle"></i></a>
				</td>-->





						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>
	</div>
	<div class="d-flex justify-content-center mt-1">
		<a class="btn btn-info m-auto mt-3" href="index.php?action=accueilForm">Retour</a>
	</div>
</main>
<main>
    <div class="overflow-auto h-50">
        <table class=" container col-12  mt-5  fs-4 table table-striped table-dark mb-3">
            <?php echo $listFormateur;?>
        </table>
    </div>
    <div class="d-flex jusitfy-content-center mt-1">
        <button type="button" class="btn btn-primary m-auto" data-bs-toggle="modal" data-bs-target="#ModalAjoutFormateur">
        Ajouter
        </button>
	</div>	
</main>

<div class="modal fade" id="ModalAjoutFormateur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout d'un formateur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

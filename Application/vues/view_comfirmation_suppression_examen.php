<main>

        <!-- Modal -->
       
         
                
            <div class="container justify-content-center"><h2 class="m-auto text-center" id="exampleModalLabel">Alerte </h2>
            <p class="text-center fs-3">Etes vous sûr.e de vouloir supprimer<p>
            </div>
            <div class="d-flex m-auto justify-content-center ">
            <a class="btn btn-danger  align-self-center m-auto " href="index.php?action=listExam" role="button">Annuler</a>
            <a class="btn btn-success align-self-center m-auto " href="index.php?action=suppressionExamenEffectue&IDSessionExam=<?php $_GET["IDSessionExam"]?>&date=<?php $_GET["date"]?>" role="button">
                    Confirmer</a>
            </div>
       
</main>


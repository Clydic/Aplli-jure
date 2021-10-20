	<main class=" bg-light  pt-2 mt-3">
    <h2 class=" text-center">Ajouter une session d'examen</h2>
    <form action="index.php?action=accueilForm" method="GET" class="d-flex flex-column col-5 col-md-4 col-lg-3 container">
        <select class="form-select" aria-label="" name="IdSessionFormation">
            <?php echo $list_formation ?>
        </select><br/>
        <input class="mt-3" type="date" name="date" value="<?php $date ?>" >
        <div class="m-auto">
            <input class="mt-3 " type="submit" value="Ajouter">
            <a href="index.php?action=listExam"><input  type="button" value="Retour"></a>
        </div>
    </form>
</main>
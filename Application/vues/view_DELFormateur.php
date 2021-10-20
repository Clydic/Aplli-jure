<main class="text-center">
    <h2>Ajouter un formateur</h2><br><br>
    <p> Etes-vous sur de vouloir supprimer <?php echo $FormSupp[2]; echo " "; echo $FormSupp[1]; ?> ?</p>
    <br><br>
    <form action="" method="GET">
        <input type="hidden" name="action" value="FctDELFormateur">
        <input type="hidden" name="idForm" value="<?php echo $FormSupp[0];?>">
        <a href="index.php?action=CRUDFormateur"><input type="button" value="Retour"></a>
        <input type="submit" value="Validez">
    </form>
</main>
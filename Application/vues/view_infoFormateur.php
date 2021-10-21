<main class="row text-center">
    <h1>Information du Formateur</h1>
    <div class="col-12 col-md-6">
        <label> Nom : </label> <p> <?php echo $info['nom']; ?> </p><br>
        <label> Prénom : </label> <p> <?php echo $info['prenom']; ?> </p><br>
        <label> Adresse 1 : </label> <p> <?php echo $info['adr1']; ?> </p><br>
        <label> Adresse 2 : </label> <p> <?php echo $info['adr2']; ?> </p><br>
    </div>
    <div class="col-12 col-md-6">
        <label> Code Postal : </label> <p> <?php echo $info['postal']; ?> </p><br>
        <label> Ville : </label> <p> <?php echo $info['ville']; ?> </p><br>
        <label> Téléphone : </label> <p> <?php echo $info['phone']; ?> </p><br>
        <label> E-Mail : </label> <?php echo $info['mail']; ?> <br>
    </div>
    <div class="col-12">
        <form action="" method="get">
            <input type="hidden" name="action" value="ModifierFormateur">
            <input type="hidden" name="idForm" value="<?php echo $info['id']; ?>">
            <a href="index.php?action=CRUDFormateur"><input type="button" value="Retour"></a>   
            <input type="submit" value="Modifier">
        </form>
    </div>
</main>
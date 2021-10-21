<main class="text-center">
    <h2>Modifier un formateur</h2><br><br>
    <form action="" method="POST" class="row">
        <div class="col-12 col-md-6">
            <label for="Nom">Nom* : </label> <input type="text" name="Nom" id="name" value="<?php echo $info['nom']; ?>" required><br><br>
            <label for="Prenom">Prénom* : </label> <input type="text" name="Prenom" id="surname" value="<?php echo $info['prenom']; ?>" required><br><br>
            <label for="Adresse1">Adresse 1* : </label> <input type="text" name="Adresse1" id="address1" value="<?php echo $info['adr1']; ?>" required><br><br>
            <label for="Adresse2">Adresse 2 : </label> <input type="text" name="Adresse2" id="address2" value="<?php echo $info['adr2']; ?>" ><br><br>
        </div>
        <div class="col-12 col-md-6">
            <label for="CodePostale">Code Postal* : </label> <input type="text" name="CodePostal" id="postalCode"  value="<?php echo $info['postal']; ?>" required><br><br>
            <label for="Ville">Ville* : </label> <input type="text" name="Ville" id="city" value="<?php echo $info['ville']; ?>" required><br><br>
            <label for="Telephone">Téléphone* : </label> <input type="text" name="Telephone" id="phone" value="<?php echo $info['phone']; ?>" required><br><br>
            <label for="Mail">E-Mail* : </label> <input type="text" name="Mail" id="mail" value="<?php echo $info['mail']; ?>" required><br><br>
        </div>
        <div class="col-12">
            <input type="hidden" name="action" value="FctModifierFormateur">
            <input type="hidden" name="idForm" value="<?php echo $info['id']; ?>">
            <a href="index.php?action=InfoFormateur&id=<?php echo $info['id']; ?>"><input type="button" value="Retour"></a>
            <input type="submit" value="Ajouter">
        </div>
    </form>
</main>
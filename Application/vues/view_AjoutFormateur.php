<main class="text-center">
    <h2>Ajouter un formateur</h2><br><br>
    <form action="" method="POST" class="row">
        <div class="col-12 col-md-6">
            <label for="Nom">Nom* : </label> <input type="text" name="Nom" id="name" required><br><br>
            <label for="Prenom">Prénom* : </label> <input type="text" name="Prenom" id="surname"required><br><br>
            <label for="Adresse1">Adresse 1* : </label> <input type="text" name="Adresse1" id="address1"required><br><br>
            <label for="Adresse2">Adresse 2 : </label> <input type="text" name="Adresse2" id="address2"><br><br>
        </div>
        <div class="col-12 col-md-6">
            <label for="CodePostale">Code Postal* : </label> <input type="text" name="CodePostale" id="postalCode" required><br><br>
            <label for="Ville">Ville* : </label> <input type="text" name="Ville" id="city" required><br><br>
            <label for="Telephone">Téléphone* : </label> <input type="text" name="Telephone" id="phone" required><br><br>
            <label for="Mail">E-Mail* : </label> <input type="text" name="Mail" id="mail" required><br><br>
        </div>
        <div class="col-12">
            <input type="hidden" name="action" value="FctAjoutFormateur">
            <a href="index.php?action=CRUDFormateur"><input type="button" value="Retour"></a>
            <input type="submit" value="Ajouter">
        </div>
    </form>
</main>
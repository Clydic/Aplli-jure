<!--vues/view_accueil.php-->
<main class=" bg-light row pt-2 h-50 mt-3">
    <div id="divAccueuil" class="row align-self-center col-md-6">
        <h1 class="text-center">BIENVENUE</h1>
    </div>
    <div id="divBTNConnect" class="row align-self-center text-center col-md-6">
        <form action="index.php" method="GET">
            <input type="hidden" name="action" value="connectForm">
            <input type="submit" value="Se Connecter en tant que Formateur" class="text-center">
        </form>
        <br><br><br>
        <form action="index.php" method="GET">
            <input type="hidden" name="action" value="connectAdmin">
            <input type="submit" value="Se Connecter en tant qu'Administrateur" class="text-center">
        </form>
    </div>
</main>
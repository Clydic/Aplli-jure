<main> <!--vues/view_list-exam.php -->
    <form action="index.php" method="GET" class="h-25">
        <select class="form-select" aria-label="Disabled select example">
            <?php echo $list_formation ?>
        </select><br/>
        <input type="date" value="10/11/2021">
        <input type="submit" value="Ajouter">
        <input type="reset" value="Retour">
    </form>
</main>
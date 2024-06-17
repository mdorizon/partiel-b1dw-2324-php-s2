<?php require_once 'parts/header.php'; ?>

<div class="container w-25 mt-5">
    <h1 class="mb-3">Nouveau billet</h1>

    <form action="scripts/post-create.php" method="POST">
        <div class="mb-3">
            <select class="form-select mb-2" name="categorie" required>
                <option selected>Catégorie</option>
                <option value="hommes">Hommes</option>
                <option value="femmes">Femmes</option>
            </select>
            <input class="form-control mb-2" type="text" name="groupe" placeholder="Groupe" required>
            <input class="form-control mb-2" type="text" name="equipe1" placeholder="Équipe 1" required>
            <input class="form-control mb-2" type="text" name="equipe2" placeholder="Équipe 2" required>
            <input class="form-control mb-2" type="datetime-local" name="date_heure" required>
            <input class="form-control mb-2" type="text" name="lieu" placeholder="Lieu" required>
            <input class="form-control mb-2" type="number" name="prix" placeholder="prix" required>
            <input class="form-control mb-2" type="text" name="description" placeholder="Description" required>
        </div>

        <?php if(isset($_GET['error'])) : ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success'])) : ?>
            <div class="alert alert-success">
            <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <input type="submit" class="btn btn-primary w-100" value="Envoyer">
    </form>
</div>


<?php require_once 'parts/footer.php'; ?>
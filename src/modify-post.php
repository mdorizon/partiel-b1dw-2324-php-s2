<?php require_once 'parts/header.php'; ?>
<?php
    // connect to db
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
    // prepare request
    $request = $connectDatabase->prepare("SELECT * FROM post WHERE id = :id");
    // bind params 
    $request->bindParam(':id', $_GET['id']);
    // execute request
    $request->execute();
    // fetch all data from table posts
    $post = $request->fetch(PDO::FETCH_ASSOC);
?>

<div class="container w-25 mt-5">
    <h1 class="mb-3">Nouveau billet</h1>

    <form action="scripts/post-modify.php" method="POST">
        <div class="mb-3">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <select class="form-select mb-2" name="categorie" required>
                <option>Catégorie</option>
                <option value="Hommes" <?= $post['categorie'] == "Hommes" ? "selected" : "" ?>>Hommes</option>
                <option value="Femmes" <?= $post['categorie'] == "Femmes" ? "selected" : "" ?>>Femmes</option>
            </select>
            <input class="form-control mb-2" type="text" name="groupe" placeholder="Groupe" value="<?= $post['groupe'] ?>" required>
            <input class="form-control mb-2" type="text" name="equipe1" placeholder="Équipe 1" value="<?= $post['equipe1'] ?>" required>
            <input class="form-control mb-2" type="text" name="equipe2" placeholder="Équipe 2" value="<?= $post['equipe2'] ?>" required>
            <input class="form-control mb-2" type="datetime-local" name="date_heure" value="<?= $post['date_heure'] ?>" required>
            <input class="form-control mb-2" type="text" name="lieu" placeholder="Lieu" value="<?= $post['lieu'] ?>" required>
            <input class="form-control mb-2" type="number" step="0.01" name="prix" placeholder="prix" value="<?= $post['prix'] ?>" required>
            <input class="form-control mb-2" type="text" name="description" placeholder="Description" value="<?= $post['description'] ?>" required>
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
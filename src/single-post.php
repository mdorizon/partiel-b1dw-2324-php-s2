<?php require_once 'parts/header.php'; ?>
<?php
    // connect to db
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
    // prepare request
    $request = $connectDatabase->prepare("SELECT * FROM post where id = :id");
    // bind params
    $request->bindParam(':id', $_GET['post_id']);
    // execute request
    $request->execute();
    // fetch all data from table posts
    $post = $request->fetch(PDO::FETCH_ASSOC);
?>

    <section class="d-flex flex-column align-items-center mt-5">
        <h2 class="mb-5">Match | <?= $post['categorie'] ?></h2>
        <div class="col-9 mb-5">
            <div class="card d-flex flex-row w-100">
                <div class="card-body">
                    <h5 class="card-subtitle mb-2 text-muted">Match | <?= $post['categorie'] ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Groupe : <?=  $post['groupe'] ?></small></p>
                    <p class="card-text"><small class="text-body-secondary"><?=  $post['equipe1'] ?> // <?=  $post['equipe2'] ?></small></p>
                    <p class="card-text"><?=  $post['description'] ?></p>
                    <?php $date = new DateTimeImmutable($post['date_heure']); ?>
                    <p class="card-text"><small class="text-body-secondary"><?= $date->format('d-m-Y') ?> | <?= $date->format('h:i') ?>h | <?= $post['lieu'] ?></small></p>
                </div>
                <div class="card-body d-flex flex-column align-items-end justify-content-center">
                    <h5 class="card-subtitle mb-2 text-muted"><?= $post['prix'] ?>€</h5>
                </div>
            </div>
        </div>
        <a type="button" class="btn btn-primary">Acheter le billet</a>
    </section>

<?php require_once 'parts/footer.php'; ?>
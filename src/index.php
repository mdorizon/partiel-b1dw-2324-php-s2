<?php require_once 'parts/header.php'; ?>
<?php 
    // connect to db
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
    // prepare request
    $request = $connectDatabase->prepare("SELECT * FROM post");
    // execute request
    $request->execute();
    // fetch all data from table posts
    $posts = $request->fetchAll(PDO::FETCH_ASSOC);
?>

    <section class="d-flex flex-column align-items-center mt-5">
        <div class="col-9">
            <div class="d-flex justify-content-between w-100">
                <h2>Liste des billets</h2>
                <a type="button" class="btn btn-primary" href="#">Ajouter un billet</a>
            </div>
            <p>filtres</p>
            <div class="feedback-list d-flex gap-4 mb-5 flex-wrap w-100">
                <?php foreach($posts as $post): ?>
                    <div class="card d-flex flex-row w-100">
                        <div class="card-body">
                            <h5 class="card-subtitle mb-2 text-muted">Match | <?= $post['categorie'] ?></h5>
                            <p class="card-text"><small class="text-body-secondary">Groupe : <?=  $post['groupe'] ?></small></p>
                            <p class="card-text"><small class="text-body-secondary"><?=  $post['equipe1'] ?> // <?=  $post['equipe2'] ?></small></p>
                            <p class="card-text"><?=  $post['description'] ?></p>
                            <?php $date = new DateTimeImmutable($post['date_heure']); ?>
                            <p class="card-text"><small class="text-body-secondary"><?= $date->format('d-m-Y') ?> | <?= $date->format('h:i') ?>h | <?= $post['lieu'] ?></small></p>
                        </div>
                        <div class="card-body d-flex flex-column align-items-end">
                            <h5 class="card-subtitle mb-2 text-muted"><?= $post['prix'] ?>€</h5>
                            <div>
                                <button type="button" class="btn btn-primary ">Voir le billet</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php require_once 'parts/footer.php'; ?>
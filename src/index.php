<?php require_once 'parts/header.php'; ?>
<?php
    $filter = $_GET['filter'] ?? 'DESC';
    switch ($filter) {
        case 'desc':
            $filterchoice = "DESC";
            break;
        case 'asc':
            $filterchoice = "ASC";
            break;
        default:
            $filterchoice = "DESC";
            break;
    }
    // connect to db
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
    // prepare request
    $request = $connectDatabase->prepare("SELECT * FROM post ORDER BY prix {$filterchoice}");
    // execute request
    $request->execute();
    // fetch all data from table posts
    $posts = $request->fetchAll(PDO::FETCH_ASSOC);
?>

    <section class="d-flex flex-column align-items-center mt-5">
        <div class="col-9">
            <div class="d-flex justify-content-between w-100">
                <h2>Liste des billets</h2>
                <a type="button" class="btn btn-primary" href="./new-post.php">Ajouter un billet</a>
            </div>
            <div class="filters mb-5 mt-3">
                <form id="filterForm">
                    <select name="filter" class="form-select" onchange="submitForm()">
                        <option value="desc" <?= $filter == 'desc' ? "selected" : "" ?>>Plus chers</option>
                        <option value="asc" <?= $filter == 'asc' ? "selected" : "" ?>>Moins chers</option>
                    </select>
                </form>
                <script>
                    function submitForm() { document.getElementById('filterForm').submit(); }
                </script>
            </div>
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
                                <a type="button" class="btn btn-primary" href="./single-post.php?post_id=<?= $post['id'] ?>">Voir le billet</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php require_once 'parts/footer.php'; ?>
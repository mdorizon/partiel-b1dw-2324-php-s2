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

    <div>
        <?php foreach($posts as $post): ?>
            <h1><?= $post['categorie']; ?></h1>
        <?php endforeach; ?>
    </div>

<?php require_once 'parts/footer.php'; ?>
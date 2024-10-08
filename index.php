<?php
    session_start();
    include "db.php";

    $sql = "SELECT id, titre, contenu, date_creation FROM articles ORDER BY id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>
<body>
    <div class="container">
        <h1>Liste des articles</h1>
        <a href="create.php" class="btnCreate">Ajouter un article</a>

        <?php if(isset($_SESSION['flash']['msg'])): ?>
            <div class="commentaire">
                <p class="<?=$_SESSION['flash']['class'] ?>">
                    <?=$_SESSION['flash']['msg']?>
                    <?php unset($_SESSION['flash']) ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="tableContainer">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titre</th>
                    <th>Date création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($articles): ?>
                    <?php foreach($articles as $article): ?>
                        <tr>
                            <td><?= $article['id'] ?></td>
                            <td><?= $article['titre'] ?></td>
                            <td><?= $article['date_creation'] ?></td>
                            <td class="actions">
                                <a href="update.php?id=<?=$article['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                <a href="delete.php?id=<?=$article['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" align="center">Pas encore d'articles encodés.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

        <div class="paginationContainer">
            <p>zone pour boutons de pagination</p>
        </div>
    </div>

</body>
</html>
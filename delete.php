<?php
    session_start();
    include "db.php";

    $msg = "";

    // est ce qu'un paramètre id est passé dans l'url ?
    if (isset($_GET['id'])) {

        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        if($stmt->execute()){
            $article = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($article) {
                // vérification présence paramètre suppression dans l'url
                if (isset($_GET['suppression'])) {
                    if ($_GET['suppression'] == 'yes') {
                        // Suppression de la base de données
                        try{
                            $sql = "DELETE FROM articles WHERE id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':id', $_GET['id']);
                            $stmt->execute();
            
                            $_SESSION["flash"] = ['class' => 'succes', 'msg' => "Article <".$_GET['id']."> supprimé avec succès."];
                            header('Location: index.php');
                            exit();
                        }catch(PDOException $e){
                            $class = "erreur";
                            $msg = $e->getMessage();
                        }
                    } else {
                        $_SESSION["flash"] = ['class' => 'succes', 'msg' => "Article <".$_GET['id']."> non supprimé comme souhaité."];
                        header('Location: index.php');
                        exit();
                    }
                }else{
                    /*
                    $_SESSION["flash"] = ['class' => 'erreur', 'msg' => "Un paramètre est manquant."];
                    header('Location: index.php');
                    exit();
                    */
                }
            }else{
                $_SESSION["flash"] = ['class' => 'erreur', 'msg' => "Article absent de la base de données."];
                header('Location: index.php');
                exit();
        }

        }else{
            $_SESSION["flash"] = ['class' => 'erreur', 'msg' => "La recherche de l'article a échoué."];
            header('Location: index.php');
            exit();
}
    } else {
        /*
        $_SESSION["flash"] = ['class' => 'erreur', 'msg' => "Un paramètre est manquant."];
        header('Location: index.php');
        exit();
        */
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Suppression d'un article</title>
</head>
<body>
    <div class="container">
        <h1>Suppression d'un article</h1>
        <?php if($msg !== ""): ?>
            <p class="delete erreur"><?= $msg ?></p>
        <?php endif; ?>
        <p class="confirmation">Confirmez-vous la suppression de l'article <<?=$_GET['id']?>> ?</p>
        <div class="buttonsDelContainer">
            <a href="delete.php?id=<?=$_GET['id']?>&suppression=yes" class="yes">Oui</a>
            <a href="delete.php?id=<?=$_GET['id']?>&suppression=no" class="no">Non</a>
        </div>
    </div>
</body>
</html>
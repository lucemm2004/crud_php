<?php
    session_start();
    include "db.php";

    $class = $msg = "";

    /*
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        $class = "erreur";
        $msg = "Le formulaire doit être soumis avec la méthode POST !";
    }

    if($msg == ""){
        if(!isset($_POST["submit"])){
            $class = "erreur";
            $msg = "Le formulaire doit être soumis en cliquant sur le bouton <Ajouter> !";
        }
    }
        */
    
    // si $_POST n'est pas vide c'est qu'on a appuyé sur le bouton Submit
    if(!empty($_POST)){
        if($msg == ""){
            if (empty($_POST["titre"])) {
                $class= "erreur";
                $msg= "Le titre est requis";
            } else {
                $titre = nettoyer_donnee($_POST["titre"]);
            }    
        }
        
        if($msg == ""){
            if (empty($_POST["contenu"])) {
                $class = "erreur";
                $msg = "Le contenu est requis";
            } else {
                $contenu = nettoyer_donnee($_POST["contenu"]);
            }    
        }
        
        if($msg == ""){
            if (empty($_POST["date-creation"])) {
                $class = "erreur";
                $msg = "La date de création est requise";
            } else {
                $dateCreation = nettoyer_donnee($_POST["date-creation"]);
            }    
        }
    
        if($msg == ""){
            // Mise à jour base de données
            try{
                $sql = "UPDATE articles SET titre = :titre, contenu = :contenu, date_creation = :date_creation WHERE id = :id";            
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':contenu', $contenu);
                $stmt->bindParam(':date_creation', $dateCreation);
                $stmt->bindParam(':id', $_GET['id']);
                if($stmt->execute()){
                    $_SESSION["flash"] = ['class' => 'succes', 'msg' => "Article <".$_GET['id']."> modifié avec succès."];
                    header("Location: index.php");
                    exit();
                }else{
                    $class = "erreur";
                    $msg = "La modification de l'article a échoué."; 
                }
            } catch(PDOException $e){
                $class = "erreur";
                $msg = $e->getMessage();
            }
        }
    }

    // si $_POST est vide ou si une anomalie s'est produite, on affiche le formulaire avec message éventuel
    $sql = "SELECT * FROM articles WHERE id = :id";
    $stmt = $pdo->prepare(($sql));
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    
    /*
    echo "<pre>";
    print_r($article);
    echo "</pre>";
    
    echo "titre - " . $article['titre'];
    echo "contenu - " . $article['contenu'];
    echo "date création - " . date("Y-m-d", strtotime($article['date_creation']));
    die();
    */

    function nettoyer_donnee($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modification d'un article</title>
</head>
<body>
    <div class="container">
        <h1>Modification d'un article</h1>
        <?php if($msg !== ""): ?>
            <p class="update erreur"><?= $msg ?></p>
        <?php endif; ?>
        <form action="update.php?id=<?= $_GET['id'] ?>" method="post">
            <input type="text" name="titre" id="titre" placeholder="Titre..." value="<?= $article['titre'] ?>" required>
            <textarea name="contenu" id="contenu" rows="10" placeholder="Contenu..." required><?= $article['contenu'] ?></textarea>
            <input type="datetime-local" name="date-creation" id="date-creation" value="<?= date('Y-m-d\TH:i', strtotime($article['date_creation'])) ?>" required>

            <div class="buttonsContainer">
                <a href="index.php">Retour à la liste des articles</a>
                <input type="submit" value="Modifier">
            </div>
        </form>
    </div>
</body>
</html>
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
            // Ajout en base de données
            try{
                $sql = "INSERT INTO articles (titre, contenu, date_creation) VALUES(:titre, :contenu, :date_creation)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':contenu', $contenu);
                $stmt->bindParam(':date_creation', $dateCreation);
                if($stmt->execute()){
                    $_SESSION["flash"] = ['class' => 'succes', 'msg' => 'Article ajouté avec succès.'];
                    header("Location: index.php");
                    exit();
                }else{
                    $class = "erreur";
                    $msg = "L'ajout de l'article a échoué."; 
                }
                } catch(PDOException $e){
                $class = "erreur";
                $msg = $e->getMessage();
            }
        }
    }

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
    <title>Ajout d'un article</title>
</head>
<body>
    <div class="container">
        <h1>Ajout d'un article</h1>
        <?php if($msg !== ""): ?>
            <p class="create erreur"><?= $msg ?></p>
        <?php endif; ?>
        <form action="create.php" method="post">
            <input type="text" name="titre" id="titre" placeholder="Titre..." required>
            <textarea name="contenu" id="contenu" rows="10" placeholder="Contenu..." required></textarea>
            <input type="datetime-local" name="date-creation" id="date-creation" value="<?=date('Y-m-d\TH:i')?>" required>

            <div class="buttonsContainer">
                <a href="index.php">Retour à la liste des articles</a>
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
</body>
</html>
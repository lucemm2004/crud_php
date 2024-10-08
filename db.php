<?php
    
    try {

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'gestion_articles';
    
        $dsn = 'mysql:dbname=' . $dbName . ';host=' . $host  . ';charset=utf8';
        $pdo = new PDO($dsn, $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Connexion réussie! <br>';
    } catch (PDOException $e) {
        echo 'Connexion échouée: ' . $e->getMessage();
    }

/*
CREATE TABLE `gestion_articles`.`articles` (`id` INT NOT NULL AUTO_INCREMENT , `titre` VARCHAR(255) NOT NULL , `contenu` TEXT NOT NULL , `date_creation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
*/

?>
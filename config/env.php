<?php
    function connexion() {
        try {
            $mysqlClient = new PDO(
                'mysql:host=localhost;dbname=artbox;charset=utf8',
                'root',
                'root'
            );
            $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $mysqlClient;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
?>
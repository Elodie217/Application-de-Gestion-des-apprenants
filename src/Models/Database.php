<?php

namespace src\Models;

use PDO;
use PDOException;

final class Database
{
    private $DB;
    private $config;

    public function __construct()
    {
        $this->config = __DIR__ . '/../../config.php';
        require_once $this->config;

        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->DB = new PDO($dsn, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $error) {
            echo "Erreur de connexion à la Base de Données : " . $error->getMessage();
        }
    }

    /**
     * Retourne la connexion BDD établie et l'objet PDO associé.
     */
    public function getDB(): PDO
    {
        return $this->DB;
    }

    /**
     * Initialisation de la Base de Données : installation des tables et mise à jour du fichier config.php
     * @return string message d'échec ou de réussite.
     */
    public function initialisationBDD(): string
    {

        // Télécharger le(s) fichier(s) sql d'initialisation dans la BDD
        // Et effectuer les différentes migrations
        try {

            $migration = __DIR__ . "/../../Public/migration/AGA.sql";
            if (file_exists($migration)) {
                $sql = file_get_contents($migration);
                $this->DB->query($sql);
            } else {
                $migrationExistante = FALSE;
            }


            // Mettre à jour le fichier config.php
            if ($this->UpdateConfig()) {
                return "installation de la Base de Données terminée !";
            }
        } catch (PDOException $erreur) {
            return "impossible de remplir la Base de données 2 : " . $erreur->getMessage();
        }
    }

    /**
     * Vérifie si la table Films existe déjà dans la BDD
     * @return bool
     */
    // private function testIfTableUserExists(): bool
    // {
    //     $existant = $this->DB->query('SHOW TABLES FROM ' . DB_NAME . ' like \'%User%\'')->fetch();

    //     if ($existant !== false && $existant[0] == PREFIXE . "User") {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


    private function UpdateConfig(): bool
    {

        $fconfig = fopen($this->config, 'w');

        $contenu = "<?php

        define('DB_HOST', 'localhost');
        define('DB_NAME', 'aga');
        define('DB_USER', 'aga');
        define('DB_PWD', 'aga');
        define('PREFIXE', 'aga_');


        define('HOME_URL', '/public/');


        define('DB_INITIALIZED', TRUE);
        ";


        if (fwrite($fconfig, $contenu)) {
            fclose($fconfig);
            return true;
        } else {
            return false;
        }
    }
}

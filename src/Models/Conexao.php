<?php

namespace Service\Models;

use PDO;
use PDOException;

require_once __DIR__ . '/../../bootstrap.php';

class Conexao
{
    private $con;

    public function __construct()
    {
        try {
            $this->con = new PDO("mysql:host=" . $_ENV['HOST'] . ";dbname=" . $_ENV['DB'], $_ENV['USER'], $_ENV['PASS'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            echo "Erro na conexão com DB: " . $e->getMessage();
        }
    }

    public function getCon()
    {
        return $this->con;
    }
}

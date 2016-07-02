<?php

/* Connect to an ODBC database using driver invocation */

class pdoConnect {

    var $dsn = 'mysql:dbname=cobrajdlr;host=localhost';
    var $user = 'root';
    var $password = 'DeathSta1';
    var $link;

    function __construct() {
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $this->link = $pdo;
    }

}

$pdoc = new pdoConnect();
$pdo = $pdoc->link;
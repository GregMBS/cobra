<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use ConfigClass;
use PDO;
use PDOException;

require_once 'config.php';

/**
 * Description of MiltClass
 *
 * @author gmbs
 */
class MiltClass {

    /**
     *
     * @var string
     */
    private $dbhost = "localhost";

    /**
     *
     * @var string
     */
    private $dbuser = "gmbs";

    /**
     *
     * @var string
     */
    private $dbpass = "DeathSta1";

    /**
     *
     * @var string
     */
    private $dbname;

    /**
     *
     * @var PDO
     */
    private $dbh;

    /**
     *
     * @var string
     */
    private $msg;

    public function __construct() {
        $config = new ConfigClass();
        $this->dbname = $config->robotDb;
        $this->dbh = $this->getDb();
    }

    /**
     * 
     * @return PDO
     */
    private function getDb() {
        try {
            $dbh = new PDO('mysql:host='.$this->dbhost.';dbname=' . $this->dbname, $this->dbuser, $this->dbpass);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die(json_encode(''));
        }
        return $dbh;
    }

    /**
     * 
     * @return array
     */
    public function getMsglist() {
        $query = "SELECT distinct auto, msg, lineas FROM msglist";
        try {
            $sth = $this->dbh->prepare($query);
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            die();
        }
        try {
            $sth->execute();
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            die();
        }
        try {
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            die();
        }
        return $result;
    }

    /**
     * 
     * @param array $row
     * @return array
     */
    public function getCalls($row) {
        $this->msg = $row['msg'];
        /*
        $lim = $row['lineas'];
        if ($lim > 100) {
            $lim = 100;
        }
        */
        $query = "SELECT auto,id,tel,turno FROM calllist 
                WHERE msg = :msg 
                AND id <> '' AND tel <> '' 
                AND turno = 0 
                ORDER BY turno LIMIT 10";
        try {
            $sth1 = $this->dbh->prepare($query);
            $sth1->bindParam(':msg', $this->msg);
            $sth1->execute();
            return $sth1->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Prepare failed: ' . $e->getMessage();
            return [];
        }
    }

    /**
     * 
     * @param array $row
     * @return array
     */
    public function getMiltOutput($row) {
        $tt = $row['tel'];
        $auto = $row['auto'];
        $cta = $row['id'];
        return array('id' => $auto, 'cuenta' => $cta, 'tel' => $tt, 'msg' => $this->msg);
    }

    /**
     * 
     * @param int $id
     */
    public function updateCount($id) {
        $botup = "UPDATE calllist SET turno=turno+1 WHERE auto = :id";
        try {
            $sth = $this->dbh->prepare($botup);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e) {
            echo 'Prepare failed: ' . $e->getMessage();
        }
    }

}
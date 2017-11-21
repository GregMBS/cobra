<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gregmbs\cobra;

use PDO;
use PDOException;

/**
 * Description of whiteClass
 *
 * @author gmbs
 */
class WhiteClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;
    private $datamatch = array(
        'tel' => 'tel',
        'nombre' => 'nomnre_deudor',
        'calle' => 'domicilio_deudor',
        'colonia' => 'colonia_deudor',
        'ciudad' => 'ciudad_deudor',
        'estado' => 'estado_deudor',
        'cp' => 'cp_deudor'
    );

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param array $data
     * @return string
     */
    public function buildQuery($data) {
        $searchstr = '';
        foreach ($data as $key => $value) {
            if (!empty($value) && isset($this->datamatch[$key])) {
                $column = $this->datamatch[$key];
                $searchstr .= " AND $column regexp :$key ";
            }
        }
        $querymain = "SELECT SQL_NO_CACHE * FROM rlook WHERE tel IS NOT NULL" . $searchstr;
        return $querymain;
    }

    /**
     * 
     * @param string $query
     * @param array $data
     * @return array
     */
    public function runQuery($query, $data) {
        try {
            $stm = $this->pdo->prepare($query);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        foreach ($data as $key => $value) {
            if (!empty($value) && isset($this->datamatch[$key])) {
                $stm->bindParam(":$key", $value);
            }
        }
        try {
            $stm->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Exception;
use PDO;
use PDOException;

/**
 * Description of whiteClass
 *
 * @author gmbs
 */
class WhiteClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    /**
     * @var string[]
     */
    private $dataMatch = array(
        'tel' => 'tel',
        'nombre' => 'nombre_deudor',
        'calle' => 'domicilio_deudor',
        'colonia' => 'colonia_deudor',
        'ciudad' => 'ciudad_deudor',
        'estado' => 'estado_deudor',
        'cp' => 'cp_deudor'
    );

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param array $data
     * @return string
     */
    public function buildQuery(array $data) {
        $searchString = '';
        foreach ($data as $key => $value) {
            if (!empty($value) && isset($this->dataMatch[$key])) {
                $column = $this->dataMatch[$key];
                $searchString .= " AND $column regexp :$key ";
            }
        }
        return "SELECT SQL_NO_CACHE * FROM rlook WHERE tel IS NOT NULL" . $searchString;
    }

    /**
     *
     * @param string $query
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function runQuery($query, $data) {
        try {
            $stm = $this->pdo->prepare($query);
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        foreach ($data as $key => $value) {
            if (!empty($value) && isset($this->dataMatch[$key])) {
                $stm->bindParam(":$key", $value);
            }
        }
        try {
            $stm->execute();
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}

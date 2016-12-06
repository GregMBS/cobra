<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of TroubleClass
 *
 * @author gmbs
 */
class TroubleClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $capt
     * @param string $reparacion
     * @param int $auto
     */
    public function updateTrouble($capt, $reparacion, $auto) {
        $queryup = "UPDATE trouble
            set fechacomp=now(),
            it_guy=:capt,
            reparacion=:reparacion
            where auto=:auto";
        $stu = $this->pdo->prepare($queryup);
        $stu->bindParam(':capt', $capt);
        $stu->bindParam(':reparacion', $reparacion);
        $stu->bindParam(':auto', $auto, \PDO::PARAM_INT);
        $stu->execute();
    }

    /**
     * 
     * @return array
     */
    public function listTrouble() {
        $querysub = "SELECT * FROM trouble ORDER BY fechahora desc";
        $rowsub = $this->pdo->query($querysub);
        return $rowsub;
    }

    /**
     * 
     * @param string $sistema
     * @param string $capt
     * @param string $fuente
     * @param string $descripcion
     * @param string $error_msg
     */
    public function insertTrouble($sistema, $capt, $fuente, $descripcion, $error_msg) {
        $queryins = "INSERT INTO trouble (sistema,usuario,fechahora,fuente,descripcion,error_msg)
VALUES (:sistema, :capt, now(), :fuente, :descripcion, :error_msg)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':sistema', $sistema);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':fuente', $fuente);
        $sti->bindParam(':descripcion', $descripcion);
        $sti->bindParam(':error_msg', $error_msg);
        $sti->exeute();
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of NotaClass
 *
 * @author gmbs
 */
class NotaClass extends BaseClass {

    /**
     * 
     * @param string $capt
     * @param int $C_CONT
     */
    public function softDeleteNotas($capt, $C_CONT) {
        $querybor = "UPDATE notas SET borrado=1
WHERE c_cvge=:capt and c_cont=:C_CONT";
        $stb = $this->pdo->prepare($querybor);
        $stb->bindParam(':capt', $capt);
        $stb->bindParam(':C_CONT', $C_CONT);
        $stb->execute();
    }

    /**
     * 
     * @param string $capt
     * @param int $AUTO
     */
    public function softDeleteOneNota($capt, $AUTO) {
        $querybins = "UPDATE notas set borrado=1 "
                . "where AUTO=:AUTO and C_CVGE=:capt";
        $stbi = $this->pdo->prepare($querybins);
        $stbi->bindParam(':capt', $capt);
        $stbi->bindParam(':AUTO', $AUTO, \PDO::PARAM_INT);
        $stbi->execute();
    }

    /**
     * 
     * @param int $AUTO
     */
    public function softDeleteOneNotaAdmin($AUTO) {
        $querybins = "UPDATE notas set borrado=1 "
                . "where AUTO=:AUTO";
        $stbi = $this->pdo->prepare($querybins);
        $stbi->bindParam(':AUTO', $AUTO, \PDO::PARAM_INT);
        $stbi->execute();
    }

    /**
     * 
     * @param string $capt
     * @param string $D_FECH
     * @param string $C_HORA
     * @param string $FECHA
     * @param string $HORA
     * @param string $NOTA
     * @param string $CUENTA
     * @param int $C_CONT
     */
    public function insertNota($capt, $D_FECH, $C_HORA, $FECHA, $HORA, $NOTA, $CUENTA, $C_CONT) {
        $queryins = "INSERT INTO notas
        (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT)
VALUES (:capt, :capt, date(:D_FECH), :C_HORA, :FECHA, :HORA, :NOTA,
:CUENTA, :C_CONT)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':D_FECH', $D_FECH);
        $sti->bindParam(':C_HORA', $C_HORA);
        $sti->bindParam(':FECHA', $FECHA);
        $sti->bindParam(':HORA', $HORA);
        $sti->bindParam(':NOTA', $NOTA);
        $sti->bindParam(':CUENTA', $CUENTA);
        $sti->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $sti->execute();
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function listMyNotas($capt) {
        $querysub = "SELECT auto,fecha,hora,nota,c_cvge,cuenta "
                . "FROM notas "
                . "WHERE c_cvge IN (:capt, 'todos') "
                . "AND borrado=0 ORDER BY fecha desc,hora desc";
        $sts = $this->pdo->prepare($querysub);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        $result = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function listAllNotas() {
        $querysub = "SELECT auto,fecha,hora,nota,c_cvge "
                . "FROM notas "
                . "WHERE borrado=0 ORDER BY fecha desc,hora desc";
        $rowsub = $this->pdo->query($querysub);
        return $rowsub;
    }

    /**
     * 
     * @param string $target
     * @param string $capt
     * @param string $FECHA
     * @param string $HORA
     * @param string $NOTA
     */
    public function insertNotaAdmin($target, $capt, $FECHA, $HORA, $NOTA) {
        $queryins = "INSERT INTO notas
            (C_CVGE, fuente, D_FECH, C_HORA, FECHA, HORA, NOTA)
            VALUES
            (:target, :capt, curdate(), curtime(), :fecha, :hora, :nota)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':target', $target);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':fecha', $FECHA);
        $sti->bindParam(':hora', $HORA);
        $sti->bindParam(':nota', $NOTA);
        $sti->execute();
    }

    /**
     * 
     * @return array
     */
    public function listUsers() {
        $queryt = "SELECT iniciales FROM nombres "
                . "ORDER BY iniciales";
        $rowt = $this->pdo->query($queryt);
        return $rowt;
    }

}

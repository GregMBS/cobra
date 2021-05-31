<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;

/**
 * Description of GestorAdminClass
 *
 * @author gmbs
 */
class GestorAdminClass {

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $completo
     * @param string $tipo
     * @param string $usuaria
     */
    public function updateOpenParams($completo, $tipo, $usuaria) {
        $query = "UPDATE nombres
            SET completo = :completo,
            tipo = :tipo
            WHERE usuaria = :usuaria";
        $stu = $this->pdo->prepare($query);
        $stu->bindParam(':completo', $completo);
        $stu->bindParam(':tipo', $tipo);
        $stu->bindParam(':usuaria', $usuaria);
        $stu->execute();
    }

    /**
     * 
     * @param string $passw
     * @param string $usuaria
     */
    public function updatePassword($passw, $usuaria) {
        $bpw = password_hash($passw, PASSWORD_DEFAULT);
        $query = "UPDATE nombres
            SET passw = :bpw
            WHERE usuaria = :usuaria
	    AND passw <> :passw";
        $stp = $this->pdo->prepare($query);
        $stp->bindParam(':bpw', $bpw);
        $stp->bindParam(':usuaria', $usuaria);
        $stp->bindParam(':passw', $passw);
        $stp->execute();
    }

    /**
     * 
     * @param string $usuaria
     */
    public function deleteFromNombres($usuaria) {
        $query = "DELETE FROM nombres WHERE usuaria = :usuaria";
        $stb = $this->pdo->prepare($query);
        $stb->bindParam(':usuaria', $usuaria);
        $stb->execute();
    }

    /**
     * 
     * @param string $usuaria
     */
    public function deleteFromQueuelist($usuaria) {
        $query = "DELETE FROM queuelist WHERE gestor = :usuaria";
        $stb = $this->pdo->prepare($query);
        $stb->bindParam(':usuaria', $usuaria);
        $stb->execute();
    }

    /**
     * 
     * @param string $usuaria
     */
    public function deleteFromResumen($usuaria) {
        $query = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig'
            WHERE ejecutivo_asignado_call_center = :usuaria";
        $stb = $this->pdo->prepare($query);
        $stb->bindParam(':usuaria', $usuaria);
        $stb->execute();
    }

    /**
     * 
     * @param string $completo
     * @param string $tipo
     * @param string $usuaria
     * @param string $iniciales
     * @param string $passw
     */
    public function addToNombres($completo, $tipo, $usuaria, $iniciales, $passw) {
        $bpw = password_hash($passw, PASSWORD_DEFAULT);
        $query = "INSERT INTO nombres (USUARIA, INICIALES, COMPLETO, PASSW,
            TIPO, CAMP) 
	VALUES (:usuaria, :iniciales, :completo, :bpw, :tipo, 999999)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':completo', $completo);
        $sti->bindParam(':tipo', $tipo);
        $sti->bindParam(':usuaria', $usuaria);
        $sti->bindParam(':iniciales', $iniciales);
        $sti->bindParam(':bpw', $bpw);
        $sti->execute();
    }

    /**
     * 
     * @param string $iniciales
     */
    public function addToQueuelists($iniciales) {
        $queryListIn = "insert ignore into queuelist
		SELECT distinct null, :iniciales, cliente, status_aarsa, 999999,
		orden1, updown1, orden2, updown2, orden3, updown3,
		sdc, bloqueado
		FROM queuelist";
        $stl = $this->pdo->prepare($queryListIn);
        $stl->bindParam(':iniciales', $iniciales);
        $stl->execute();
        $queryListCamp = "update queuelist
            set camp=auto where camp=999999";
        $this->pdo->query($queryListCamp);
    }

    /**
     * 
     * @return array
     */
    public function getNombres() {
        $query = "SELECT USUARIA, COMPLETO, TIPO, CAMP, INICIALES, PASSW 
    FROM nombres 
    where iniciales NOT IN ('gmbs','natalya')
    order by TIPO, USUARIA";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getGroups() {
        $query = "SELECT grupo FROM grupos";
        $result = $this->pdo->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}

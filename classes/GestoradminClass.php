<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDOStatement;

/**
 * Description of GestoradminClass
 *
 * @author gmbs
 */
class GestoradminClass {

    /**
     *
     * @var \PDO 
     */
    private $pdo;

    /**
     * 
     * @param \PDO $pdo
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
        $queryu = "UPDATE nombres
            SET completo = :completo,
            tipo = :tipo
            WHERE usuaria = :usuaria";
        $stu = $this->pdo->prepare($queryu);
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
        $queryp = "UPDATE nombres
            SET passw = :bpw
            WHERE usuaria = :usuaria
	    AND passw <> :passw";
        $stp = $this->pdo->prepare($queryp);
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
        $queryb = "DELETE FROM nombres WHERE usuaria = :usuaria";
        $stb = $this->pdo->prepare($queryb);
        $stb->bindParam(':usuaria', $usuaria);
        $stb->execute();
    }

    /**
     * 
     * @param string $usuaria
     */
    public function deleteFromQueuelist($usuaria) {
        $queryb = "DELETE FROM queuelist WHERE gestor = :usuaria";
        $stb = $this->pdo->prepare($queryb);
        $stb->bindParam(':usuaria', $usuaria);
        $stb->execute();
    }

    /**
     * 
     * @param string $usuaria
     */
    public function deleteFromResumen($usuaria) {
        $queryb = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig'
            WHERE ejecutivo_asignado_call_center = :usuaria";
        $stb = $this->pdo->prepare($queryb);
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
        $queryin = "INSERT INTO nombres (USUARIA, INICIALES, COMPLETO, PASSW,
            TIPO, CAMP) 
	VALUES (:usuaria, :iniciales, :completo, :bpw, :tipo, 999999)";
        $sti = $this->pdo->prepare($queryin);
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
        $querylistin = "insert ignore into queuelist
		SELECT distinct null, :iniciales, cliente, status_aarsa, 999999,
		orden1, updown1, orden2, updown2, orden3, updown3,
		sdc, bloqueado
		FROM queuelist;";
        $stl = $this->pdo->prepare($querylistin);
        $stl->bindParam(':iniciales', $iniciales);
        $stl->execute();
        $querylistcamp = "update queuelist
            set camp=auto where camp=999999;";
        $this->pdo->query($querylistcamp);
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function getNombres() {
        $querymain = "SELECT USUARIA, COMPLETO, TIPO, CAMP, INICIALES, PASSW 
    FROM nombres 
    where iniciales <> 'gmbs'
    order by TIPO, USUARIA";
        return $this->pdo->query($querymain);
    }

    /**
     * 
     * @return array
     */
    public function getGroups() {
        $queryg = "SELECT grupo FROM grupos";
        $resultg = $this->pdo->query($queryg);
        $groups = $resultg->fetchAll(\PDO::FETCH_ASSOC);
        return $groups;
    }

}

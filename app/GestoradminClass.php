<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app;

/**
 * Description of GestoradminClass
 *
 * @author gmbs
 */
class GestoradminClass extends BaseClass {

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
        $queryp = "UPDATE nombres
            SET passw = sha(:passw)
            WHERE usuaria = :usuaria
	    AND passw <> :passw";
        $stp = $this->pdo->prepare($queryp);
        $stp->bindParam(':passw', $passw);
        $stp->bindParam(':usuaria', $usuaria);
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
        $queryin = "INSERT INTO nombres (USUARIA, INICIALES, COMPLETO, PASSW,
            TIPO, CAMP) 
	VALUES (:usuaria, :iniciales, :completo, sha(:passw), :tipo, 999999)";
        $sti = $this->pdo->prepare($queryin);
        $sti->bindParam(':completo', $completo);
        $sti->bindParam(':tipo', $tipo);
        $sti->bindParam(':usuaria', $usuaria);
        $sti->bindParam(':iniciales', $iniciales);
        $sti->bindParam(':passw', $passw);
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
		FROM queuelist";
        $stl = $this->pdo->prepare($querylistin);
        $stl->bindParam(':iniciales', $iniciales);
        $stl->execute();
        $querylistcamp = "update queuelist
            set camp=auto where camp=999999";
        $this->pdo->query($querylistcamp);
    }

    /**
     * 
     * @return array
     */
    public function getNombres() {
        $querymain = "SELECT USUARIA, COMPLETO, TIPO, CAMP, INICIALES, PASSW 
    FROM nombres 
    where iniciales <> 'gmbs'
    order by TIPO, USUARIA";
        $result = $this->pdo->query($querymain);
        return $result;
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

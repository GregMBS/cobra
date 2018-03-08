<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

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
    private function updateOpenParams($completo, $tipo, $capt) {
        $queryu = "UPDATE users
            SET completo = :completo,
            tipo = :tipo
            WHERE iniciales = :capt";
        $stu = $this->pdo->prepare($queryu);
        $stu->bindParam(':completo', $completo);
        $stu->bindParam(':tipo', $tipo);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
    }

    /**
     * 
     * @param string $passw
     * @param string $usuaria
     */
    private function updatePassword($passw, $capt) {
        if ((strlen($passw) < 50) && (strlen($passw) > 0)) {
            $queryp = "UPDATE users
                SET password = :passw
                WHERE iniciales = :capt";
            $stp = $this->pdo->prepare($queryp);
            $stp->bindValue(':passw', bcrypt($passw));
            $stp->bindParam(':usuaria', $capt);
            $stp->execute();
        }
    }

    /**
     * 
     * @param string $capt
     */
    private function deleteFromUsers($capt) {
        $queryb = "DELETE FROM users WHERE iniciales = :capt";
        $stb = $this->pdo->prepare($queryb);
        $stb->bindParam(':capt', $capt);
        $stb->execute();
    }

    /**
     * 
     * @param string $capt
     */
    private function deleteFromQueuelist($capt) {
        $queryb = "DELETE FROM queuelist WHERE gestor = :capt";
        $stb = $this->pdo->prepare($queryb);
        $stb->bindParam(':capt', $capt);
        $stb->execute();
    }

    /**
     * 
     * @param string $capt
     */
    private function deleteFromResumen($capt) {
        $queryb = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig'
            WHERE ejecutivo_asignado_call_center = :capt";
        $stb = $this->pdo->prepare($queryb);
        $stb->bindParam(':capt', $capt);
        $stb->execute();
    }

    /**
     * 
     * @param string $completo
     * @param string $tipo
     * @param string $iniciales
     * @param string $passw
     */
    private function addToUsers($completo, $tipo, $iniciales, $passw) {
        $queryin = "INSERT INTO users (iniciales, completo, password,
            tipo, camp) 
	VALUES (:iniciales, :completo, :passw, :tipo, 999999)";
        $sti = $this->pdo->prepare($queryin);
        $sti->bindParam(':completo', $completo);
        $sti->bindParam(':tipo', $tipo);
        $sti->bindParam(':iniciales', $iniciales);
        $sti->bindValue(':passw', bcrypt($passw));
        $sti->execute();
    }

    /**
     * 
     * @param string $iniciales
     */
    private function addToQueuelists($iniciales) {
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
        $querymain = "(SELECT completo, tipo, camp, iniciales, password as pwd
    FROM users
    WHERE iniciales <> 'gmbs')
    UNION
(SELECT completo, tipo, camp, iniciales, passw as pwd
    FROM nombres
    WHERE iniciales <> 'gmbs')    
    order by tipo, iniciales";
        $result = $this->pdo->query($querymain);
        return $result;
    }

    /**
     * 
     * @return string[]
     */
    public function getGroups() {
        $queryg = "SELECT grupo FROM grupos";
        $stg = $this->pdo->query($queryg);
        $result = $stg->fetchAll(\PDO::FETCH_ASSOC);
        $groups = array_column($result, 'grupo');
        return $groups;
    }

    /**
     * 
     * @param string $completo
     * @param string $tipo
     * @param string $iniciales
     * @param string $passwd
     */
    public function changeUserData($completo, $tipo, $iniciales, $passwd)
    {
        $this->updateOpenParams($completo, $tipo, $iniciales);
        $this->updatePassword($passwd, $iniciales);
    }
    
    /**
     * 
     * @param string $iniciales
     */
    public function removeUser($iniciales) {
        $this->deleteFromUsers($iniciales);
        $this->deleteFromQueuelist($iniciales);
        $this->deleteFromResumen($iniciales);
    }
    
    /**
     * 
     * @param string $completo
     * @param string $tipo
     * @param string $iniciales
     * @param string $passw
     */
    public function addUser($completo, $tipo, $iniciales, $passw) {
        $this->addToUsers($completo, $tipo, $iniciales, $passw);
        $this->addToQueuelists($iniciales);
    }
}

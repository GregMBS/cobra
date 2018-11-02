<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of AgentAdminClass
 *
 * @author gmbs
 */
class AgentAdminClass extends BaseClass {

    /**
     * 
     * @param string $completo
     * @param string $tipo
     * @param string $capt
     */
    private function updateOpenParams($completo, $tipo, $capt) {
        $query = "UPDATE users
            SET completo = :completo,
            tipo = :tipo
            WHERE iniciales = :capt";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':completo', $completo);
        $stu->bindValue(':tipo', $tipo);
        $stu->bindValue(':capt', $capt);
        $stu->execute();
    }

    /**
     * 
     * @param string $pass
     * @param string $capt
     */
    private function updatePassword($pass, $capt) {
        if ((strlen($pass) < 50) && (strlen($pass) > 0)) {
            $query = "UPDATE users
                SET password = :pass
                WHERE iniciales = :capt";
            $stp = $this->pdo->prepare($query);
            $stp->bindValue(':pass', bcrypt($pass));
            $stp->bindValue(':capt', $capt);
            $stp->execute();
        }
    }

    /**
     * 
     * @param string $capt
     */
    private function deleteFromUsers($capt) {
        $query = "DELETE FROM users WHERE iniciales = :capt";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':capt', $capt);
        $stb->execute();
    }

    /**
     * 
     * @param string $capt
     */
    protected function deleteFromQueuelist($capt) {
        $query = "DELETE FROM queuelist WHERE gestor = :capt";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':capt', $capt);
        $stb->execute();
    }

    /**
     * 
     * @param string $capt
     */
    protected function deleteFromResumen($capt) {
        $query = "UPDATE resumen SET ejecutivo_asignado_call_center='sinasig'
            WHERE ejecutivo_asignado_call_center = :capt";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':capt', $capt);
        $stb->execute();
    }

    /**
     * 
     * @param string $completo
     * @param string $tipo
     * @param string $iniciales
     * @param string $pass
     */
    protected function addToUsers($completo, $tipo, $iniciales, $pass) {
        $query = "INSERT INTO users (iniciales, completo, password,
            tipo, camp) 
	VALUES (:iniciales, :completo, :pass, :tipo, 999999)";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':completo', $completo);
        $sti->bindValue(':tipo', $tipo);
        $sti->bindValue(':iniciales', $iniciales);
        $sti->bindValue(':pass', bcrypt($pass));
        $sti->execute();
    }

    /**
     * 
     * @param string $iniciales
     */
    protected function addToQueuelist($iniciales) {
        $queryListIn = "insert ignore into queuelist
		SELECT distinct null, :iniciales, cliente, status_aarsa, 999999,
		orden1, updown1, orden2, updown2, orden3, updown3,
		sdc, bloqueado
		FROM queuelist";
        $stl = $this->pdo->prepare($queryListIn);
        $stl->bindValue(':iniciales', $iniciales);
        $stl->execute();
        $queryListCamp = "update queuelist
            set camp=auto where camp=999999";
        $this->pdo->query($queryListCamp);
    }

    /**
     * 
     * @return array
     */
    public function getNames() {
        $query = "(SELECT completo, tipo, camp, iniciales, password as pwd, name
    FROM users
    WHERE iniciales <> 'gmbs')
    UNION
(SELECT completo, tipo, camp, iniciales, passw as pwd, null as name
    FROM nombres
    WHERE iniciales <> 'gmbs')    
    order by tipo, iniciales";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return string[]
     */
    public function getGroups() {
        $query = "SELECT grupo FROM grupos";
        $stg = $this->pdo->query($query);
        $result = $stg->fetchAll(\PDO::FETCH_ASSOC);
        $groups = array_column($result, 'grupo');
        return $groups;
    }

    /**
     *
     * @param GestorDataClass $dataClass
     * @return string
     */
    public function changeUserData(GestorDataClass $dataClass)
    {
        $data = $dataClass->getUser();
        $this->updateOpenParams($data->completo, $data->tipo, $data->iniciales);
        $this->updatePassword($data->pass, $data->iniciales);
        return $data->iniciales;
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
     * @param GestorDataClass $dataClass
     * @return string
     */
    public function addUser(GestorDataClass $dataClass)
    {
        $data = $dataClass->getUser();
        $this->addToUsers($data->completo, $data->tipo, $data->iniciales, $data->pass);
        $this->addToQueuelist($data->iniciales);
        return $data->iniciales;
    }
}

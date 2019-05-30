<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of LoginClass
 *
 * @author gmbs
 */
class LoginClass extends BaseClass {

    /**
     * @param User $user
     * @return array
     */
    public function getUserData(User $user) {
        return $user->toArray();
    }

    /**
     * 
     * @param string $cpw
     * @param string $capt
     * @param string $tipo
     */
    private function setTicket($cpw, $capt, $tipo) {
        $query = "update users "
                . "set ticket = :cpw "
                . "where iniciales = :capt "
                . "and tipo = :tipo";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':cpw', $cpw);
        $stc->bindValue(':capt', $capt);
        $stc->bindValue(':tipo', $tipo);
        $stc->execute();
    }
    
    /**
     * 
     * @param string $capt
     */
    private function setInitialQueue($capt) {
        $query = "update users n, queuelist qu
			set n.camp = qu.camp
			where iniciales = gestor
			and status_aarsa = 'Inicial'
			and tipo = 'callcenter'
			and gestor = :capt";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':capt', $capt);
        $stq->execute();
    }
    
    /**
     * 
     * @param string $capt
     * @param string $local
     */
    private function setUserlog($capt, $local) {
        $queryDelete = "delete from userlog "
                . "where gestor = :capt ";
        $std = $this->pdo->prepare($queryDelete);
        $std->bindValue(':capt', $capt);
        $std->execute();
        $queryInsert = "insert into userlog (usuario,tipo,fechahora,gestor) "
                . "values (:local, 'login', now(), :capt)";
        $sti = $this->pdo->prepare($queryInsert);
        $sti->bindValue(':capt', $capt);
        $sti->bindValue(':local', $local);
        $sti->execute();
    }
    
    /**
     * 
     * @param string $capt
     * @param string $local
     */
    private function insertPermanentLog($capt, $local) {
        $query = "insert into permalog (usuario,tipo,fechahora,gestor) values (:local, 'login', now(), :capt)";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':capt', $capt);
        $sti->bindValue(':local', $local);
        $sti->execute();
    }
    
    /**
     * 
     * @param string $capt
     */
    private function insertHistoria($capt) {
        $query = "INSERT INTO historia
			(C_CVGE,C_CVBA,C_CONT,CUENTA,C_CVST,D_FECH,C_HRIN,C_HRFI)
			VALUES (:capt, '', 0, 0, 'login', curdate(), curtime(), curtime())";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':capt', $capt);
        $sti->execute();
    }
    
    /**
     * 
     * @param string $capt
     * @param string $pw
     * @return string
     */
    private function setCookie($capt, $pw) {
        $cpw = $capt.sha1($pw).date('U');
        return $cpw;
    }
    
    /**
     * 
     * @param string $capt
     * @param string $pwd
     * @param string $tipo
     * @param string $local
     * @return string cookie
     */
    public function processLogin($capt, $pwd, $tipo, $local) {
        $cookie = $this->setCookie($capt, $pwd);
        $this->setTicket($cookie, $capt, $tipo);
        $this->setInitialQueue($capt);
        $this->setUserlog($capt, $local);
        $this->insertPermanentLog($capt, $local);
        $this->insertHistoria($capt);
        return $cookie;
    }
    
}

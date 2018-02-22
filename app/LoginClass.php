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
     * 
     * @param string $capt
     * @param string $pw
     * @return array
     */
    public function getUserData($capt, $pw) {
        $queryg = "SELECT iniciales, enlace, tipo "
                . "FROM nombres JOIN grupos ON grupo=tipo "
                . "WHERE passw = sha(:pw) "
                . "AND LOWER(iniciales) = LOWER(:capt) "
                . "LIMIT 1";
        $stg = $this->pdo->prepare($queryg);
        $stg->bindParam(':pw', $pw);
        $stg->bindParam(':capt', $capt);
        $stg->execute();
        $resultg = $stg->fetch(\PDO::FETCH_ASSOC);
        return $resultg;
    }

    /**
     * 
     * @param string $cpw
     * @param string $capt
     * @param string $tipo
     */
    private function setTicket($cpw, $capt, $tipo) {
        $queryc = "update nombres "
                . "set ticket = :cpw "
                . "where iniciales = :capt "
                . "and tipo = :tipo";
        $stc = $this->pdo->prepare($queryc);
        $stc->bindParam(':cpw', $cpw);
        $stc->bindParam(':capt', $capt);
        $stc->bindParam(':tipo', $tipo);
        $stc->execute();
    }
    
    /**
     * 
     * @param string $capt
     */
    private function setInitialQueue($capt) {
        $queryq = "update nombres n, queuelist qu
			set n.camp = qu.camp
			where iniciales = gestor
			and status_aarsa = 'Inicial'
			and tipo = 'callcenter'
			and gestor = :capt";
        $stq = $this->pdo->prepare($queryq);
        $stq->bindParam(':capt', $capt);
        $stq->execute();
    }
    
    /**
     * 
     * @param string $capt
     * @param string $local
     */
    private function setUserlog($capt, $local) {
        $queryu = "delete from userlog "
                . "where gestor = :capt ";
        $stdu = $this->pdo->prepare($queryu);
        $stdu->bindParam(':capt', $capt);
        $stdu->execute();
        $queryl = "insert into userlog (usuario,tipo,fechahora,gestor) "
                . "values (:local, 'login', now(), :capt)";
        $stlu = $this->pdo->prepare($queryl);
        $stlu->bindParam(':capt', $capt);
        $stlu->bindParam(':local', $local);
        $stlu->execute();
    }
    
    /**
     * 
     * @param string $capt
     * @param string $local
     */
    private function insertPermalog($capt, $local) {
        $querypl = "insert into permalog "
                . "(usuario,tipo,fechahora,gestor) "
                . "values (:local, 'login', now(), :capt)";
        $stlp = $this->pdo->prepare($querypl);
        $stlp->bindParam(':capt', $capt);
        $stlp->bindParam(':local', $local);
        $stlp->execute();
    }
    
    /**
     * 
     * @param string $capt
     */
    private function insertHistoria($capt) {
        $queryins = "INSERT INTO historia
			(C_CVGE,C_CVBA,C_CONT,CUENTA,C_CVST,D_FECH,C_HRIN,C_HRFI)
			VALUES (:capt, '', 0, 0, 'login', curdate(), curtime(), curtime())";
        $stih = $this->pdo->prepare($queryins);
        $stih->bindParam(':capt', $capt);
        $stih->execute();
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
        $this->insertPermalog($capt, $local);
        $this->insertHistoria($capt);
        return $cookie;
    }
    
}

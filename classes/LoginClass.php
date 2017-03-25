<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gregmbs\cobra;

/**
 * Description of LoginClass
 *
 * @author gmbs
 */
class LoginClass {

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
     * @param string $passw
     * @return array
     */
    public function getUserData($capt, $passw) {
        $queryg = "SELECT iniciales, enlace, tipo                                
                FROM nombres JOIN grupos ON grupo=tipo  
                WHERE passw = sha(:pw)  
                AND LOWER(iniciales) = LOWER(:capt)  
                LIMIT 1";
        try {
            $stg = $this->pdo->prepare($queryg);
            $stg->bindParam(':pw', $passw);
            $stg->bindParam(':capt', $capt);
            $stg->execute();
            $resultg = $stg->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exc) {
            die($exc->getMessage());
        }
        if ($resultg) {
            return $resultg;
        } else {
            die($queryg . ' ' . $capt . ' ' . $passw);
        }
    }

    /**
     * 
     * @param string $cpw
     * @param string $capt
     */
    private function setTicket($cpw, $capt) {
        $queryc = "update nombres "
                . "set ticket = :cpw "
                . "where iniciales = :capt";
        try {
            $stc = $this->pdo->prepare($queryc);
            $stc->bindParam(':cpw', $cpw, \PDO::PARAM_STR);
            $stc->bindParam(':capt', $capt, \PDO::PARAM_STR);
            $stc->execute();
        } catch (PDO $exc) {
            die($exc->getTraceAsString());
        }
    }

    /**
     * 
     * @param string $cpw
     * @param string $capt
     * @return boolean
     */
    private function testTicket($cpw, $capt) {
        $queryc = "select ticket "
                . "from nombres "
                . "where iniciales = :capt";
        try {
            $stc = $this->pdo->prepare($queryc);
            $stc->bindParam(':capt', $capt);
            $stc->execute();
            $result = $stc->fetch(\PDO::FETCH_ASSOC);
        } catch (PDO $exc) {
            die($exc->getTraceAsString());
        }
        $test = $result['ticket'] != $cpw;
        return $test;
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
     * @param string $cpw
     * @param string $capt
     * @param string $local
     * @return boolean
     */
    public function doLogin($cpw, $capt, $local) {
        $this->setTicket($cpw, $capt);
        $this->setInitialQueue($capt);
        $this->setUserlog($capt, $local);
        $this->insertPermalog($capt, $local);
        $this->insertHistoria($capt);
        return $this->testTicket($cpw, $capt);
    }

}

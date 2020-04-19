<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

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

    public function getUserData($capt, $pw) {
        //$bpw = password_hash($pw, PASSWORD_DEFAULT);
        $queryg = "SELECT iniciales, enlace, tipo, passw "
                . "FROM nombres JOIN grupos ON grupo=tipo "
                . "WHERE LOWER(iniciales) = LOWER(:capt) "
                . "LIMIT 1";
        $stg = $this->pdo->prepare($queryg);
        $stg->bindParam(':capt', $capt);
        $stg->execute();
        $resultg = $stg->fetch(\PDO::FETCH_ASSOC);
        if (password_verify($pw, $resultg['passw'])) {
            return $resultg;
        }
        if (sha1($pw) == $resultg['passw']) {
            return $resultg;
        }
        return FALSE;
    }

    /**
     * 
     * @param string $cpw
     * @param string $capt
     * @param string $tipo
     */
    public function setTicket($cpw, $capt, $tipo) {
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
    public function setInitialQueue($capt) {
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
    public function setUserlog($capt, $local) {
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
    public function insertPermalog($capt, $local) {
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
    public function insertHistoria($capt) {
        $queryins = "INSERT INTO historia
			(C_CVGE,C_CVBA,C_CONT,CUENTA,C_CVST,D_FECH,C_HRIN,C_HRFI)
			VALUES (:capt, '', 0, 0, 'login', curdate(), curtime(), curtime())";
        $stih = $this->pdo->prepare($queryins);
        $stih->bindParam(':capt', $capt);
        $stih->execute();
    }
}

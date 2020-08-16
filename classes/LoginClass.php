<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/UserDataObject.php';

/**
 * Description of LoginClass
 *
 * @author gmbs
 */
class LoginClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param $capt
     * @param $pw
     * @return UserDataObject
     */
    public function getUserData($capt, $pw) {
        $query = "SELECT nombres.* 
        FROM nombres JOIN grupos ON grupo=tipo 
        WHERE LOWER(iniciales) = LOWER(:capt) 
        LIMIT 1";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':capt', $capt);
        $stg->execute();
        /** @var UserDataObject $result */
        $result = $stg->fetchObject(UserDataObject::class);
        if (password_verify($pw, $result->passw)) {
            return $result;
        }
        if (sha1($pw) == $result->passw) {
            return $result;
        }
        return new UserDataObject();
    }

    /**
     * @param string $tipo
     * @return string
     */
    public function getLink(string $tipo) {
        $query = "SELECT enlace 
        FROM grupos 
        WHERE grupo = :tipo 
        LIMIT 1";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':tipo', $tipo);
        $stg->execute();
        $result = $stg->fetchColumn(0);
        if ($result) {
            return $result;
        }
        return '';
    }

    /**
     * 
     * @param string $cpw
     * @param string $capt
     * @param string $tipo
     */
    private function setTicket($cpw, $capt, $tipo) {
        $query = "update nombres 
        set ticket = :cpw 
        where iniciales = :capt
        and tipo = :tipo";
        $stc = $this->pdo->prepare($query);
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
        $query = "update nombres n, queuelist qu
			set n.camp = qu.camp
			where iniciales = gestor
			and status_aarsa = 'Inicial'
			and tipo = 'callcenter'
			and gestor = :capt";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':capt', $capt);
        $stq->execute();
    }
    
    /**
     * 
     * @param string $capt
     * @param string $local
     */
    private function setUserlog($capt, $local) {
        $query1 = "delete from userlog where gestor = :capt ";
        $std = $this->pdo->prepare($query1);
        $std->bindParam(':capt', $capt);
        $std->execute();
        $query2 = "insert into userlog (usuario,tipo,fechahora,gestor) 
        values (:local, 'login', now(), :capt)";
        $stl = $this->pdo->prepare($query2);
        $stl->bindParam(':capt', $capt);
        $stl->bindParam(':local', $local);
        $stl->execute();
    }
    
    /**
     * 
     * @param string $capt
     * @param string $local
     */
    private function insertPermalog($capt, $local) {
        $query = "insert into permalog 
        (usuario,tipo,fechahora,gestor) 
        values (:local, 'login', now(), :capt)";
        $stl = $this->pdo->prepare($query);
        $stl->bindParam(':capt', $capt);
        $stl->bindParam(':local', $local);
        $stl->execute();
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
        $sti->bindParam(':capt', $capt);
        $sti->execute();
    }

    /**
     * @param string $cpw
     * @param $capt
     * @param UserDataObject $userData
     * @param $local
     * @return string
     */
    function runLogin(string $cpw, $capt, UserDataObject $userData, $local): string
    {
        $this->setTicket($cpw, $capt, $userData->TIPO);
        $this->setInitialQueue($capt);
        $this->setUserlog($capt, $local);
        $this->insertPermalog($capt, $local);
        $this->insertHistoria($capt);
        return $this->getLink($userData->TIPO);
    }

}

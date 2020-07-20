<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;

/**
 * Description of LogoutClass
 *
 * @author gmbs
 */
class LogoutClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;
    
    /**
     *
     * @var string 
     */
    protected $queryldt = "select d_fech,c_hrfi from historia 
                    where c_cvge = :capt
                    order by d_fech desc,c_hrin desc 
                    limit 1";

    /**
     * 
     * @var string
     */
    public $date;
    
    /**
     *
     * @var string
     */
    public $time;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $capt
     */
    public function unlockCuentas($capt) {
        $queryunlock = "UPDATE resumen "
                . "SET timelock = NULL, locker = NULL "
                . "WHERE locker = :capt";
        $stu = $this->pdo->prepare($queryunlock);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
    }

    /**
     *
     * @param string $capt
     * @param string $go
     * @return LogoutClass
     */
    public function getLogoutDatetime($capt, $go) {
        $this->date = date('Y-m-d');
        $this->time = date('H:i:s');
        if ($go == 'forgot') {
            $stl = $this->pdo->prepare($this->queryldt);
            $stl->bindParam(':capt', $capt);
            $stl->execute();
            $resultldt = $stl->fetch(PDO::FETCH_ASSOC);
            if ($resultldt) {
                $this->date = $resultldt['d_fech'];
                $this->time = $resultldt['c_hrin'];
            }
        }
        return $this;
    }

    /**
     * 
     * @param string $capt
     * @param string $go
     * @param string $date
     * @param string $time
     */
    public function insertHistoria($capt, $go, $date, $time) {
	$queryins	 = "INSERT INTO historia
		(C_CVGE, C_CVBA, C_CONT, CUENTA, C_CVST, D_FECH, C_HRIN, C_HRFI)
		VALUES
		(:capt,'', 0, 0, :go, :date, :timein, :timeout)";
	$sti		 = $this->pdo->prepare($queryins);
	$sti->bindParam(':capt', $capt);
	$sti->bindParam(':go', $go);
	$sti->bindParam(':date', $date);
	$sti->bindParam(':timein', $time);
	$sti->bindParam(':timeout', $time);
	$sti->execute();
    }
    
    /**
     * 
     * @param string $capt
     */
    public function clearResumenLocks($capt) {
	$queryclr	 = "UPDATE resumen SET locker=NULL, timelock=NULL "
	    ."WHERE locker = :capt";
	$stc		 = $this->pdo->prepare($queryclr);
	$stc->bindParam(':capt', $capt);
	$stc->execute();
    }
    
    /**
     * 
     * @param string $capt
     */
    public function clearRslice($capt) {
	$querydel	 = "DELETE from rslice "
	    ."WHERE user = :capt";
	$std		 = $this->pdo->prepare($querydel);
	$std->bindParam(':capt', $capt);
	$std->execute();
    }
    
    /**
     * 
     * @param string $capt
     */
    public function expireTicket($capt) {
	$querynom	 = "update nombres set ticket = NULL "
	    ."where iniciales = :capt";
	$stn		 = $this->pdo->prepare($querynom);
	$stn->bindParam(':capt', $capt);
	$stn->execute();
    }
}

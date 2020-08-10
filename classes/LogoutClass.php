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
class LogoutClass
{

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
     * @var PDO $pdo
     */
    protected $pdo;
    /**
     *
     * @var string
     */
    protected $queryLastDateTime = "select d_fech,c_hrfi from historia 
                    where c_cvge = :capt
                    order by d_fech desc,c_hrin desc 
                    limit 1";

    /**
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @param string $capt
     */
    public function unlockCuentas($capt)
    {
        $query = "UPDATE resumen 
        SET timelock = NULL, locker = NULL 
        WHERE locker = :capt";
        $stu = $this->pdo->prepare($query);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
    }

    /**
     *
     * @param string $capt
     * @param string $go
     */
    private function getLogoutDatetime($capt, $go)
    {
        $this->date = date('Y-m-d');
        $this->time = date('H:i:s');
        if ($go == 'forgot') {
            $stl = $this->pdo->prepare($this->queryLastDateTime);
            $stl->bindParam(':capt', $capt);
            $stl->execute();
            $result = $stl->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $this->date = $result['d_fech'];
                $this->time = $result['c_hrin'];
            }
        }
    }

    /**
     *
     * @param string $capt
     * @param string $go
     */
    private function insertHistoria($capt, $go)
    {
        $query = "INSERT INTO historia
		(C_CVGE, C_CVBA, C_CONT, CUENTA, C_CVST, D_FECH, C_HRIN, C_HRFI)
		VALUES
		(:capt,'', 0, 0, :go, :date, :time_in, :timeout)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':go', $go);
        $sti->bindParam(':date', $this->date);
        $sti->bindParam(':time_in', $this->time);
        $sti->bindParam(':timeout', $this->time);
        $sti->execute();
    }

    /**
     *
     * @param string $capt
     */
    private function clearResumenLocks($capt)
    {
        $query = "UPDATE resumen SET locker=NULL, timelock=NULL 
        WHERE locker = :capt";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
    }

    /**
     *
     * @param string $capt
     */
    private function clearRslice($capt)
    {
        $query = "DELETE from rslice 
        WHERE user = :capt";
        $std = $this->pdo->prepare($query);
        $std->bindParam(':capt', $capt);
        $std->execute();
    }

    /**
     *
     * @param string $capt
     */
    private function expireTicket($capt)
    {
        $query = "update nombres set ticket = NULL 
        where iniciales = :capt";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':capt', $capt);
        $stn->execute();
    }

    /**
     * @param string $capt
     * @param string $go
     */
    public function runLogout(string $capt, string $go)
    {
        $this->getLogoutDatetime($capt, $go);
        $this->insertHistoria($capt, $go);
        $this->clearResumenLocks($capt);
        $this->clearRslice($capt);
        $this->expireTicket($capt);
    }
}

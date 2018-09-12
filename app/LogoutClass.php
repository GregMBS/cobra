<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Carbon\Carbon;

/**
 * Description of LogoutClass
 *
 * @author gmbs
 */
class LogoutClass extends BaseClass
{

    /**
     *
     * @var string
     */
    protected $queryDateTime = "select d_fech,c_hrfi,c_hrin from historia 
                    where c_cvge = :capt
                    order by d_fech desc,c_hrin desc 
                    limit 1";

    /**
     *
     * @param string $capt
     */
    private function unlockCuentas($capt)
    {
        $query = "UPDATE resumen "
            . "SET timeLock = NULL, locker = NULL "
            . "WHERE locker = :capt";
        $stu = $this->pdo->prepare($query);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
    }

    /**
     *
     * @param string $capt
     * @param string $why
     * @return \Carbon\Carbon
     */
    private function getLogoutDatetime($capt, $why)
    {
        $carbon = new Carbon();
        $dt = $carbon->now();
        if ($why == 'forgot') {
            /** @var \PDOStatement $stl */
            $stl = $this->pdo->prepare($this->queryDateTime);
            $stl->bindParam(':capt', $capt);
            $stl->execute();
            $result = $stl->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                $date = $result['d_fech'];
                $time = $result['c_hrin'];
                $dt = $carbon->createFromFormat('Y-m-d H:i:s', $date . ' ' . $time);
            }
        }
        return $dt;
    }

    /**
     *
     * @param string $capt
     * @param string $go
     * @param string $date
     * @param string $time
     */
    private function insertHistoria($capt, $go, $date, $time)
    {
        $query = "INSERT INTO historia
		(C_CVGE, C_CVBA, C_CONT, CUENTA, C_CVST, D_FECH, C_HRIN, C_HRFI)
		VALUES
		(:capt,'', 0, 0, :go, :date, :timeIn, :timeout)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':go', $go);
        $sti->bindParam(':date', $date);
        $sti->bindParam(':timeIn', $time);
        $sti->bindParam(':timeout', $time);
        $sti->execute();
    }

    /**
     *
     * @param string $capt
     */
    private function clearResumenLocks($capt)
    {
        $query = "UPDATE resumen SET locker=NULL, timeLock=NULL "
            . "WHERE locker = :capt";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
    }

    /**
     *
     * @param string $capt
     */
    private function clearRSlice($capt)
    {
        $query = "DELETE from rslice "
            . "WHERE user = :capt";
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
        $query = "update nombres set ticket = NULL "
            . "where iniciales = :capt";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':capt', $capt);
        $stn->execute();
    }

    /**
     *
     * @param string $capt
     * @param string $why
     */
    public function processLogout($capt, $why)
    {
        $this->unlockCuentas($capt);
        $dt = $this->getLogoutDatetime($capt, $why);
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $this->insertHistoria($capt, $why, $date, $time);
        $this->clearResumenLocks($capt);
        $this->clearRSlice($capt);
        $this->expireTicket($capt);
    }
}

<?php

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
     * @var string|null
     */
    public ?string $date;
    /**
     *
     * @var string|null
     */
    public ?string $time;
    /**
     * @var PDO $pdo
     */
    protected PDO $pdo;
    /**
     *
     * @var string
     */
    protected string $queryLastDateTime = "select d_fech,c_hrfi from historia 
                    where c_cvge = :capt
                    order by d_fech desc,c_hrin desc 
                    limit 1";

    /**
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @param string $capt
     */
    public function unlockCuentas(string $capt): void
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
    private function getLogoutDatetime(string $capt, string $go): void
    {
        $this->date = date('Y-m-d');
        $this->time = date('H:i:s');
        if ($go === 'forgot') {
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
    private function insertHistoria(string $capt, string $go): void
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
    private function clearResumenLocks(string $capt): void
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
    private function expireTicket(string $capt): void
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
    public function runLogout(string $capt, string $go): void
    {
        $this->getLogoutDatetime($capt, $go);
        $this->insertHistoria($capt, $go);
        $this->clearResumenLocks($capt);
        $this->expireTicket($capt);
    }
}

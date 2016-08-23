<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of BreaksClass
 *
 * @author gmbs
 */
class BreaksClass {

    /**
     *
     * @var \PDO
     */
    private $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $TIEMPO
     * @param string $GESTOR
     * @return array
     */
    function getTimes($TIEMPO, $GESTOR) {
        $queryq = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as 'diff',
min(c_hrin) as 'minhr'
from historia 
where c_cvge=:gestor and d_fech=curdate()
and c_hrin>:tiempo;";
        $sdq = $this->pdo->prepare($queryq);
        $sdq->bindParam(':tiempo', $TIEMPO);
        $sdq->bindParam(':gestor', $GESTOR);
        $sdq->execute();
        $resultq = $sdq->fetchAll();
        return $resultq;
    }

    /**
     * 
     * @param string $capt
     */
    function clearUserlog($capt) {
        $queryl = "delete from userlog where gestor = :capt";
        $sdl = $this->pdo->prepare($queryl);
        $sdl->bindParam(':capt', $capt);
        $sdl->execute();
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    function getBreaksTable($capt) {
        $queryp = "select auto,c_cvge,c_cvst,c_hrin,
time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as 'diff'
from historia 
where c_cont=0 
and d_fech=curdate() 
and c_cvst<>'login' 
and c_cvst<>'salir' 
and c_cvge=:capt 
order by c_cvge,c_cvst,c_hrin";
        $sdp = $this->pdo->prepare($queryp);
        $sdp->bindParam(':capt', $capt);
        $sdp->execute();
        $resultp = $sdp->fetchAll();
        return $resultp;
    }

}

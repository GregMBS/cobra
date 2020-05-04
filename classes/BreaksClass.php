<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;
use PDOStatement;

/**
 * Description of BreaksClass
 *
 * @author gmbs
 */
class BreaksClass {

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     * 
     * @param PDO $pdo
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
        return $sdq->fetchAll();
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
        return $sdp->fetchAll();
    }

    /**
     * 
     * @param int $auto
     * @param string $tipo
     * @param string $empieza
     * @param string $termina
     */
    public function updateBreak($auto, $tipo, $empieza, $termina) {
        $queryu = "UPDATE breaks
            SET tipo=:tipo,
            empieza=:empieza,
            termina=:termina
            WHERE auto=:auto";
        $stu = $this->pdo->prepare($queryu);
        $stu->bindParam(':auto', $auto, PDO::PARAM_INT);
        $stu->bindParam(':tipo', $tipo);
        $stu->bindParam(':empieza', $empieza);
        $stu->bindParam(':termina', $termina);
        $stu->execute();
    }

    /**
     * 
     * @param int $auto
     */
    public function deleteBreak($auto) {
        $queryb = "DELETE FROM breaks WHERE auto=:auto";
        $stb = $this->pdo->prepare($queryb);
        $stb->bindParam(':auto', $auto, PDO::PARAM_INT);
        $stb->execute();
    }

    /**
     * 
     * @param string $gestor
     * @param string $tipo
     * @param string $empieza
     * @param string $termina
     */
    public function insertBreak($gestor, $tipo, $empieza, $termina) {
        $queryin = "INSERT INTO breaks (gestor, tipo, empieza, termina)
	VALUES (:gestor,:tipo,:empieza,:termina)";
        $sta = $this->pdo->prepare($queryin);
        $sta->bindParam(':gestor', $gestor);
        $sta->bindParam(':tipo', $tipo);
        $sta->bindParam(':empieza', $empieza);
        $sta->bindParam(':termina', $termina);
        $sta->execute();
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function listBreaks() {
        $querymain = "SELECT auto, gestor, tipo, empieza, termina FROM breaks 
    order by gestor,empieza";
        return $this->pdo->query($querymain);
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function listUsuarias() {
        $query = "SELECT iniciales FROM nombres "
                . "WHERE tipo <> ''";
        return $this->pdo->query($query);
    }
}

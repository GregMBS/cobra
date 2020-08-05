<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/BreaksObject.php';

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
        $query = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as 'diff',
min(c_hrin) as 'minhr'
from historia 
where c_cvge=:gestor and d_fech=curdate()
and c_hrin>:tiempo;";
        $sdq = $this->pdo->prepare($query);
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
        $query = "delete from userlog where gestor = :capt";
        $sdl = $this->pdo->prepare($query);
        $sdl->bindParam(':capt', $capt);
        $sdl->execute();
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    function getBreaksTable($capt) {
        $query = "select auto,c_cvge,c_cvst,c_hrin,
time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as 'diff'
from historia 
where c_cont=0 
and d_fech=curdate() 
and c_cvst<>'login' 
and c_cvst<>'salir' 
and c_cvge=:capt 
order by c_cvge,c_cvst,c_hrin";
        $sdp = $this->pdo->prepare($query);
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
        $query = "UPDATE breaks
            SET tipo=:tipo,
            empieza=:empieza,
            termina=:termina
            WHERE auto=:auto";
        $stu = $this->pdo->prepare($query);
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
        $query = "DELETE FROM breaks WHERE auto=:auto";
        $stb = $this->pdo->prepare($query);
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
        $query = "INSERT INTO breaks (gestor, tipo, empieza, termina)
	VALUES (:gestor,:tipo,:empieza,:termina)";
        $sta = $this->pdo->prepare($query);
        $sta->bindParam(':gestor', $gestor);
        $sta->bindParam(':tipo', $tipo);
        $sta->bindParam(':empieza', $empieza);
        $sta->bindParam(':termina', $termina);
        $sta->execute();
    }

    /**
     * 
     * @return array
     */
    public function listBreaks() {
        $query = "SELECT * FROM breaks ORDER BY gestor,empieza";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, BreaksObject::class);
    }

    /**
     * 
     * @return array
     */
    public function listUsuarias() {
        $query = "SELECT iniciales FROM nombres 
        WHERE tipo <> ''";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchColumn(0);
    }
}

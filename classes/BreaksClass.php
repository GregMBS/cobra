<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/BreaksObject.php';
require_once __DIR__ . '/BreaksTableObject.php';

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
    private PDO $pdo;

    /**
     * @var string
     */
    private string $queryBreaks = "select auto,c_cvge,c_hrin,c_cvst,
time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as 'diff' 
from historia 
where c_cont=0 and d_fech=curdate() and c_cvst<>'login' 
and c_cvst<>'salir' and c_cvge=:capt 
order by c_cvge,c_hrin";

    /**
     * @var string
     */
    private string $queryBreaksAdmin = "select auto,c_cvge,c_hrin,c_cvst,
time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as 'diff' 
from historia 
where c_cont=0 and d_fech=curdate() and c_cvst<>'login' 
and c_cvst<>'salir'
order by c_cvge,c_hrin";

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $TIEMPO
     * @param string $GESTOR
     * @return array
     */
    function getTimes(string $TIEMPO, string $GESTOR): array
    {
        $query = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as 'diff',
min(c_hrin) as 'minHr'
from historia 
where c_cvge=:gestor and d_fech=curdate()
and c_hrin>:tiempo";
        $sdq = $this->pdo->prepare($query);
        $sdq->bindParam(':tiempo', $TIEMPO);
        $sdq->bindParam(':gestor', $GESTOR);
        $sdq->execute();
        return $sdq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $capt
     */
    function clearUserlog(string $capt) {
        $query = "delete from userlog where gestor = :capt";
        $sdl = $this->pdo->prepare($query);
        $sdl->bindParam(':capt', $capt);
        $sdl->execute();
    }

    /**
     * 
     * @param string $capt
     * @return BreaksTableObject[]
     */
    function getBreaksTable(string $capt): array
    {
        $sdp = $this->pdo->prepare($this->queryBreaksAdmin);
        if ($capt !== 'gmbs') {
            $sdp = $this->pdo->prepare($this->queryBreaks);
            $sdp->bindParam(':capt', $capt);
        }
        $sdp->execute();
        return $sdp->fetchAll(PDO::FETCH_CLASS, BreaksTableObject::class);
    }

    /**
     * 
     * @param int $auto
     * @param string $tipo
     * @param string $empieza
     * @param string $termina
     */
    public function updateBreak(int $auto, string $tipo, string $empieza, string $termina) {
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
    public function deleteBreak(int $auto) {
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
    public function insertBreak(string $gestor, string $tipo, string $empieza, string $termina) {
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
     * @return BreaksObject[]
     */
    public function listBreaks(): array
    {
        $query = "SELECT * FROM breaks ORDER BY gestor,empieza";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, BreaksObject::class);
    }

    /**
     * 
     * @return array
     */
    public function listUsuarias(): array
    {
        $query = "SELECT iniciales FROM nombres WHERE tipo <> ''";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_COLUMN, 0);
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App;

/**
 * Description of BreaksClass
 *
 * @author gmbs
 */
class BreaksClass extends BaseClass
{

    /**
     *
     * @param string $TIEMPO
     * @param string $GESTOR
     * @return array
     */
    private function getTimes($TIEMPO, $GESTOR)
    {
        $query = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as 'diff',
min(c_hrin) as 'minhr'
from historia 
where c_cvge=:gestor and d_fech=curdate()
and c_hrin>:tiempo";
        $sdq = $this->pdo->prepare($query);
        $sdq->bindParam(':tiempo', $TIEMPO);
        $sdq->bindParam(':gestor', $GESTOR);
        $sdq->execute();
        $result = $sdq->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $capt
     */
    public function clearUserlog($capt)
    {
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
    private function getMainBreaksTable($capt)
    {
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
        $resultp = $sdp->fetchAll();
        return $resultp;
    }

    /**
     *
     * @param int $auto
     * @param string $tipo
     * @param string $empieza
     * @param string $termina
     */
    public function updateBreak($auto, $tipo, $empieza, $termina)
    {
        $queryu = "UPDATE breaks
            SET tipo=:tipo,
            empieza=:empieza,
            termina=:termina
            WHERE auto=:auto";
        $stu = $this->pdo->prepare($queryu);
        $stu->bindParam(':auto', $auto, \PDO::PARAM_INT);
        $stu->bindParam(':tipo', $tipo);
        $stu->bindParam(':empieza', $empieza);
        $stu->bindParam(':termina', $termina);
        $stu->execute();
    }

    /**
     *
     * @param int $auto
     */
    public function deleteBreak($auto)
    {
        $queryb = "DELETE FROM breaks WHERE auto=:auto";
        $stb = $this->pdo->prepare($queryb);
        $stb->bindParam(':auto', $auto, \PDO::PARAM_INT);
        $stb->execute();
    }

    /**
     *
     * @param string $gestor
     * @param string $tipo
     * @param string $empieza
     * @param string $termina
     */
    public function insertBreak($gestor, $tipo, $empieza, $termina)
    {
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
     * @return array
     */
    public function listBreaks()
    {
        $query = "SELECT auto, gestor, tipo, empieza, termina FROM breaks 
    order by gestor,empieza";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_BOTH);
        return $result;
    }

    /**
     *
     * @return array
     */
    public function listUsuarias()
    {
        $query = "SELECT iniciales FROM nombres 
                    WHERE tipo <> ''";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_BOTH);
        return $result;
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function breaksPageData($capt) {
        $main = $this->getMainBreaksTable($capt);
        dd($main);
        if ($main) {
            $main['formatstr']	 = ' class="late"';
            $main['ntp'] = date('H:i:s');
            foreach ($main as &$m) {
                $times = $this->getTimes($m['diff'], $m['c_cvge']);
                if (!empty($times['diff'])) {
                    $m['diff'] = $times['diff'];
                    $m['ntp'] = $times['minhr'];
                    $m['formatstr'] = '';
                }
            }
        }
        return $main;
    }
}

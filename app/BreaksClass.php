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
        dd($sdq, $TIEMPO, $GESTOR);
        $sdq->execute();
        $result = $sdq->fetch(\PDO::FETCH_ASSOC);
        return $result;
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
        $result = $sdp->fetchAll();
        return $result;
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
        $bc = new Breaks();
        /**
         * @var Breaks $break
         */
        $break = $bc->find($auto);
        $break->tipo = $tipo;
        $break->empieza = $empieza;
        $break->termina = $termina;
        $break->save();
    }

    /**
     * @param int $auto
     * @return bool|null
     * @throws \Exception
     */
    public function deleteBreak($auto)
    {
        $bc = new Breaks();
        /**
         * @var Breaks $break
         */
        $break = $bc->find($auto);
        $check = $break->delete();
        return $check;
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
        /** @var Breaks $break */
        $break = new Breaks();
        $break->gestor = $gestor;
        $break->tipo = $tipo;
        $break->empieza = $empieza;
        $break->termina = $termina;
        $break->save();
    }

    /**
     *
     * @return array
     */
    public function listBreaks()
    {
        $bc = new Breaks();
        $result = $bc->all()->toArray();
        return $result;
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    public function breaksPageData($capt)
    {
        $main = $this->getMainBreaksTable($capt);
        if ($main) {
            $main['formatstr'] = ' class="late"';
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

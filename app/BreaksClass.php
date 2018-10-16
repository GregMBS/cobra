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
     * @param int $tiempo
     * @param string $gestor
     * @return array
     */
    private function getTimes($tiempo, $gestor)
    {
        $query = "select (time_to_sec(min(c_hrin))-:tiempos) as 'diff',
min(c_hrin) as 'minhr'
from historia 
where c_cvge=:gestor and d_fech=curdate()
and c_hrin>:tiempo";
        $sdq = $this->pdo->prepare($query);
        $sdq->bindValue(':tiempos', $tiempo);
        $sdq->bindValue(':tiempo', $tiempo);
        $sdq->bindValue(':gestor', $gestor);
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
        $query = "select auto,C_CVGE,C_CVST,C_HRIN,
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
        $result = $sdp->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param BreaksDataClass $dataClass
     */
    public function updateBreak(BreaksDataClass $dataClass)
    {
        $data = $dataClass->getBreak();
        $bc = new Breaks();
        /**
         * @var Breaks $break
         */
        $break = $bc->find($data->auto);
        $break->tipo = $data->tipo;
        $break->empieza = $data->empieza;
        $break->termina = $data->termina;
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
     * @param BreaksDataClass $dataClass
     */
    public function insertBreak(BreaksDataClass $dataClass)
    {
        $data = $dataClass->getBreak();
        /** @var Breaks $break */
        $break = new Breaks();
        $break->gestor = $data->gestor;
        $break->tipo = $data->tipo;
        $break->empieza = $data->empieza;
        $break->termina = $data->termina;
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
        $output = array();
        if ($main) {
            foreach ($main as $m) {
                $temp = (object) $m;
                $temp->formatstr = ' class="late"';
                $temp->ntp = date('H:i:s');
                $times = $this->getTimes(0, 'gregb');
                if (!empty($times['diff'])) {
                    $temp->diff = $times['diff'];
                    $temp->ntp = $times['minhr'];
                    $temp->formatstr = '';
                }
                $output[] = (array) $temp;
            }
        }
        return $output;
    }
}

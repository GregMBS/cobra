<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Builder;

/**
 * Description of BreaksClass
 *
 * @author gmbs
 */
class BreaksClass extends BaseClass
{

    /**
     *
     * @param string $tiempo
     * @param string $gestor
     * @return array
     */
    private function getTimes($tiempo, $gestor)
    {
        /** @var Builder $hc */
        $hc = new Historia();
        /** @var Builder $query */
        $query = $hc->selectRaw("time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as 'diff',
min(c_hrin) as 'minhr'", ['tiempo' => $tiempo])
            ->where('d_fech','=', date('Y-m-d'))
            ->where('c_hrin', '>', $tiempo)
            ->where('c_cvge', $gestor);
        $result = $query->get()->toArray();
        /*
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
        */
        return $result;
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    private function getMainBreaksTable($capt)
    {
        /** @var Builder $hc */
        $hc = new Historia();
        /** @var Builder $query */
        $query = $hc->where('c_cont', '=', 0)
            ->where('d_fech','=', date('Y-m-d'))
            ->whereNotIn('c_cvst', ['login', 'salir'])
            ->where('c_cvge', $capt)
            ->orderBy('c_cvge')
            ->orderBy('c_cvst')
            ->orderBy('c_hrin');
        $main = $query->get()->toArray();
        foreach ($main as &$m) {
            $now = time();
            $then = strtotime($m['d_fech'] . ' ' . $m['c_hrin']);
            $m['diff'] = $now - $then;
        }
/*
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
*/
        return $main;
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

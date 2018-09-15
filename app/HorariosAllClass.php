<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database Class for horarios
 *
 * @author gmbs
 */
class HorariosAllClass extends BaseClass
{
    /**
     * 
     * @param int $dom
     * @return array
     */
    public function getCurrentMain($dom)
    {
        $day = $dom . ' day of last month';
        $date = date('Y-m-d', strtotime($day));
        $hc = new Historia();
        $query = $hc
            ->selectRaw("count(distinct c_cont) as cuentas,
            sum(c_cvst like 'PROMESA DE%') as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos")
            ->leftJoin('dictamenes', 'c_cvst', '=', 'dictamen')
            ->whereNull('c_cniv')
            ->whereNull('c_msge')
            ->where('d_fech', '=', $date);
        $result = $query->first();
        return $result->toArray();
    }

    /**
     * 
     * @param int $dom
     * @return array
     */
    public function getPagos($dom)
    {
        $day = $dom . ' day of last month';
        $date = date('Y-m-d', strtotime($day));
        $pc = new Pago();
        $query = $pc->whereFecha($date);
        $count = $query->count();
        return ['ct' => $count];
    }

    /**
     * 
     * @return int
     */
    public function countAccounts()
    {
        $day = 'last day of last month';
        $date = date('Y-m-d', strtotime($day));
        $hc = new Historia();
        $query = $hc->distinct()->select(['c_cont'])->where('c_cont', '>', 0)
            ->whereNull('c_cniv')
            ->whereNull('c_msge')
            ->where('d_fech', '>', $date);
        $count = $query->count();
        return $count;
    }

    /**
     * 
     * @param int $dom
     * @return int
     */
    public function countAccountsPerDay($dom)
    {
        $day = $dom . ' day of last month';
        $date = date('Y-m-d', strtotime($day));
        $hc = new Historia();
        $query = $hc->distinct()->select(['c_cont'])->where('c_cont', '>', 0)
            ->whereNull('c_cniv')
            ->whereNull('c_msge')
            ->where('d_fech', '=', $date);
        $count = $query->count();
        return $count;
    }
}
<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Query\Builder;

/**
 * Hours worked this month by all
 *
 * @author gmbs
 */
class HoursAllClass extends BaseClass
{
    /**
     * 
     * @param int $dom
     * @return array
     */
    public function getCurrentMain(int $dom)
    {
        $start = date('Y-m-d', strtotime("last day of last month"));
        $text = $start . " + $dom days";
        $date = date('Y-m-d', strtotime($text));
        /** @var Builder $hc */
        $hc = new History();
        $select = "count(distinct c_cont) as cuentas, " .
            "sum(n_prom > 0) as promesas, " .
            "count(1) as gestiones, " .
            "count(1)-sum(queue='SIN CONTACTOS') as nocontactos, " .
            "sum(queue='SIN CONTACTOS') as contactos";
        $query = $hc->selectRaw($select)
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
    public function getPayments($dom)
    {
        $day = $dom . ' day of last month';
        $date = date('Y-m-d', strtotime($day));
        $pc = new Payment();
        /** @var Builder $query */
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
        /** @var Builder $hc */
        $hc = new History();
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
        /** @var Builder $hc */
        $hc = new History();
        $query = $hc->distinct()->select(['c_cont'])->where('c_cont', '>', 0)
            ->whereNull('c_cniv')
            ->whereNull('c_msge')
            ->where('d_fech', '=', $date);
        $count = $query->count();
        return $count;
    }
}
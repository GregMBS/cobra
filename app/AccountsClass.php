<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Query\Builder;

/**
 * Description of AccountsClass
 *
 * @author gmbs
 */
class AccountsClass extends BaseClass
{

    /**
     *
     * @return array
     */
    public function adminReport()
    {
        /** @var Builder $rc */
        $rc = new Debtor();
        /** @var Builder $query */
        $query = $rc->where('status_de_credito', 'NOT REGEXP', '-');
        $result = $query->get();
        return $result->toArray();
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    public function userReport($capt)
    {
        /** @var Debtor|Builder $rc */
        $rc = new Debtor();
        /** @var Builder $debtors */
        $debtors = $rc->whereEjecutivoAsignadoCallCenter($capt);
        $query = $debtors->where('status_de_credito', 'NOT REGEXP', '-');
        $result = $query->get();
        return $result->toArray();
    }

}

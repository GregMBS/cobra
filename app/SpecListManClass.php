<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Query\Builder;

/**
 * Description of SpeclistmanClass
 *
 * @author gmbs
 */
class SpecListManClass extends BaseClass {

    /**
     *
     * @param string $cliente
     * @param string $sdc
     * @return Builder|\Illuminate\Support\Collection
     */
    public function getReport($cliente, $sdc) {
        /** @var Builder $resumen */
        $resumen = Resumen::whereStatusDeCredito($sdc);
        /** @var Builder $result */
        $result = $resumen->join('dictamenes', 'dictamen', '=', 'status_aarsa')
            ->leftJoin('pagos', 'pagos.id_cuenta', '=', 'resumen.id_cuenta')
            ->where('resumen.cliente', '=', $cliente);
        $result = $result->where('especial', '>', 0)
            ->distinct()
            ->select(['numero_de_cuenta', 'nombre_deudor', 'saldo_total', 'status_aarsa',
'ejecutivo_asignado_call_center', 'status_de_credito',
'resumen.cliente as cli', 'fecha_ultima_gestion', 'especial', 'saldo_descuento_2'])
            ->orderBy('especial')
            ->orderByDesc('saldo_descuento_2')
            ->get();
        return $result;
    }

}

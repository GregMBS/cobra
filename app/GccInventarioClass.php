<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of InventarioClass
 *
 * @author gmbs
 */
class GccInventarioClass extends BaseClass {

    /**
     *
     * @var string 
     */
    private $querymainstart = "SELECT numero_de_cuenta,nombre_deudor,resumen.cliente,
    status_de_credito,saldo_total,d1.queue,
    domicilio_deudor,direccion_nueva,email_deudor,
tel_1,(tel_1 in (select c_tele from livelines))*(1-(tel_1 in (select c_tele from deadlines))) as 't1 efectivo',
tel_2,(tel_2 in (select c_tele from livelines))*(1-(tel_2 in (select c_tele from deadlines))) as 't2 efectivo',
tel_3,(tel_3 in (select c_tele from livelines))*(1-(tel_3 in (select c_tele from deadlines))) as 't3 efectivo',
tel_4,(tel_4 in (select c_tele from livelines))*(1-(tel_4 in (select c_tele from deadlines))) as 't4 efectivo',
tel_1_verif,(tel_1_verif in (select c_tele from livelines))*(1-(tel_1_verif in (select c_tele from deadlines))) as 't1v efectivo',
tel_2_verif,(tel_2_verif in (select c_tele from livelines))*(1-(tel_2_verif in (select c_tele from deadlines))) as 't2v efectivo',
tel_3_verif,(tel_3_verif in (select c_tele from livelines))*(1-(tel_3_verif in (select c_tele from deadlines))) as 't3v efectivo',
tel_4_verif,(tel_4_verif in (select c_tele from livelines))*(1-(tel_4_verif in (select c_tele from deadlines))) as 't4v efectivo',
tel_1_laboral,(tel_1_laboral in (select c_tele from livelines))*(1-(tel_1_laboral in (select c_tele from deadlines))) as 't1l efectivo',
tel_2_laboral,(tel_2_laboral in (select c_tele from livelines))*(1-(tel_2_laboral in (select c_tele from deadlines))) as 't2l efectivo',
tel_1_ref_1,(tel_1_ref_1 in (select c_tele from livelines))*(1-(tel_1_ref_1 in (select c_tele from deadlines))) as 't1r1 efectivo',
tel_1_ref_2,(tel_1_ref_2 in (select c_tele from livelines))*(1-(tel_1_ref_2 in (select c_tele from deadlines))) as 't1r2 efectivo'
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
where status_de_credito not regexp '-' 
";

    /**
     *
     * @var string 
     */
    private $querymainend = " 
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta";

    /**
     * 
     * @param string $cliente
     * @return array
     */
    public function getInventarioReport($cliente) {
        $clientestr = '';
        if ($cliente != 'todos') {
            $clientestr = " and cliente=:cliente ";
        }
        $querymain = $this->querymainstart . $clientestr . $this->querymainend;
        $stm = $this->pdo->prepare($querymain);
        if ($cliente != 'todos') {
            $stm->bindParam(':cliente', $cliente);
        }
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function listClients() {
        $queryc = "SELECT cliente FROM clientes";
        $resultc = $this->pdo->query($queryc);
        return $resultc;
    }

}

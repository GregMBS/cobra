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
class InventarioClass extends BaseClass {

    /**
     *
     * @var string
     */
    private $fullquerymainstart = "SELECT numero_de_cuenta,nombre_deudor,resumen.cliente,
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
tel_2_laboral,(tel_2_laboral in (select c_tele from livelines))*(1-(tel_2_laboral in (select c_tele from deadlines))) as 't2l efectivo'
    from resumen
left join dictamenes d1 on status_aarsa=d1.dictamen
where status_de_credito not regexp '-'
";
    
    /**
     *
     * @var string
     */
    private $fullquerymainend = "
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta";
    
    /**
     *
     * @var string 
     */
    private $querymainstart = "SELECT id_cuenta,numero_de_cuenta,nombre_deudor,resumen.cliente,
    substring_index(status_de_credito,'-',1) as segmento,
    if (status_de_credito regexp '-',substring_index(status_de_credito,'-',-1),'') as disposicion,
    producto,subproducto,
    saldo_total,d1.queue,saldo_descuento_1,saldo_descuento_2,
    domicilio_deudor,colonia_deudor,ciudad_deudor, estado_deudor,cp_deudor,
    ejecutivo_asignado_call_center, ejecutivo_asignado_domiciliario,
count(historia.auto) as gestiones, sum(c_carg<>'') as contactos, fecha_de_asignacion
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
left join historia on id_cuenta=c_cont
and d_fech>curdate() - interval 6 month
where status_de_credito not regexp '-' 
";

    /**
     *
     * @var string 
     */
    private $querymainend = " 
group by id_cuenta
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
     * @param string $cliente
     * @return array
     */
    public function getFullInventarioReport($cliente) {
        $clientestr = '';
        if ($cliente != 'todos') {
            $clientestr = " and cliente=:cliente ";
        }
        $querymain = $this->fullquerymainstart . $clientestr . $this->fullquerymainend;
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

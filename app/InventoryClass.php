<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of InventoryClass
 *
 * @author gmbs
 */
class InventoryClass extends BaseClass {

    /**
     *
     * @var string
     */
    private $fullQueryMainStart = "SELECT numero_de_cuenta,nombre_deudor,resumen.cliente,
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
    private $fullQueryMainEnd = "
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta";
    
    /**
     *
     * @var string 
     */
    private $queryMainStart = "SELECT id_cuenta,numero_de_cuenta,nombre_deudor,resumen.cliente,
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
    private $queryMainEnd = " 
group by id_cuenta,queue
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta";

    /**
     *
     * @param string $client
     * @return array
     */
    public function getInventoryReport($client) {
        $clientString = '';
        if ($client != 'todos') {
            $clientString = " and cliente=:cliente ";
        }
        $query = $this->queryMainStart . $clientString . $this->queryMainEnd;
        $stm = $this->pdo->prepare($query);
        if ($client != 'todos') {
            $stm->bindValue(':cliente', $client);
        }
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     *
     * @param string $client
     * @return array
     */
    public function getFullInventoryReport($client) {
        $clientString = '';
        if ($client != 'todos') {
            $clientString = " and cliente=:cliente ";
        }
        $query = $this->fullQueryMainStart . $clientString . $this->fullQueryMainEnd;
        $stm = $this->pdo->prepare($query);
        if ($client != 'todos') {
            $stm->bindValue(':cliente', $client);
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
        $query = "SELECT cliente FROM clientes";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

}

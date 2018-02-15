<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

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
     * @return array
     */
    public function listClients() {
        $queryc = "SELECT cliente FROM clientes";
        $resultc = $this->pdo->query($queryc);
        return $resultc;
    }

}

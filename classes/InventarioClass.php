<?php

namespace cobra_salsa;

use PDO;

/**
 * Description of InventarioClass
 *
 * @author gmbs
 */
class InventarioClass {

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     *
     * @var string 
     */
    private $queryStart = "SELECT id_cuenta,numero_de_cuenta,nombre_deudor,resumen.cliente,
    substring_index(status_de_credito,'-',1) as segmento,
    if (status_de_credito regexp '-',substring_index(status_de_credito,'-',-1),'') as disposicion,
    producto,subproducto,
    saldo_total,max(d1.queue) as 'queue',saldo_descuento_1,saldo_descuento_2,
    domicilio_deudor,colonia_deudor,ciudad_deudor, estado_deudor,cp_deudor,
    tel_1 as 'tel_casa', tel_2 as 'tel_cel',
    ejecutivo_asignado_call_center, ejecutivo_asignado_domiciliario,
    count(historia.auto) as gestiones, sum(c_carg<>'') as contactos, fecha_de_asignacion, 
    fecha_de_ultimo_pago, monto_ultimo_pago
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
    private $queryEnd = " 
group by id_cuenta
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta";

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

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
        $querymain = $this->queryStart . $clientestr . $this->queryEnd;
        $stm = $this->pdo->prepare($querymain);
        if ($cliente != 'todos') {
            $stm->bindParam(':cliente', $cliente);
        }
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return string[]
     */
    public function listClients() {
        $query = "SELECT cliente FROM clientes";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_COLUMN, 0);
    }

}

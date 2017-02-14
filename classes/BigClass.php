<?php

namespace cobra_salsa;

use cobra_salsa\BigInputObject;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database queries for 'big' reports
 *
 * @author gmbs
 *
 */
class BigClass extends BaseClass {

    /**
     *
     * @var string
     */
    private $queryFront;
    
    /**
     *
     * @var string
     */
    private $queryBack;
    
    /**
     * 
     * @param string $direction
     * @return string
     */
    private function cleanDirection($direction) {
        $haystack = array('asc', 'ASC', 'desc', 'DESC');
        if (!in_array($direction, $haystack)) {
            $direction = 'ASC';
        }
        return $direction;
    }

    /**
     * 
     * @param string $gestor
     * @return string
     */
    private function getGestorStr($gestor) {
        if ($gestor != 'todos') {
            $gestorstr = " and c_cvge = :gestor ";
        } else {
            $gestorstr = "";
        }
        return $gestorstr;
    }

    /**
     * 
     * @param string $cliente
     * @return string
     */
    private function getClienteStr($cliente) {
        if ($cliente != 'todos') {
            $clientestr = " and resumen.cliente = :cliente ";
        } else {
            $clientestr = "";
        }
        return $clientestr;
    }

    /**
     * 
     * @param string $queryFront
     * @param string $queryBack
     * @param string $fecha1
     * @param string $fecha2
     * @param string $gestor
     * @param string $cliente
     * @return array
     */
    private function getHistoria($fecha1, $fecha2, $gestor, $cliente) {
        $query = $this->queryFront 
                . $this->getGestorStr($gestor) 
                . $this->getClienteStr($cliente) 
                . $this->queryBack;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':fecha1', $fecha1);
        $stq->bindParam(':fecha2', $fecha2);
        if ($gestor != 'todos') {
            $stq->bindParam(':gestor', $gestor);
        }
        if ($cliente != 'todos') {
            $stq->bindParam(':cliente', $cliente);
        }
        $stq->execute();
        $data = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     * 
     * @param string $fecha1
     * @param string $fecha2
     * @param string $gestor
     * @param string $cliente
     * @return array
     */
    public function getAllPagos($fecha1, $fecha2, $gestor, $cliente) {
        $this->queryFront = "select Status_aarsa AS 'STATUS',ejecutivo_asignado_call_center AS 'GESTOR',
    numero_de_cuenta as 'CUENTA',nombre_deudor as 'NOMBRE',
    saldo_descuento_1 as 'SALDO CAPITAL s/i',saldo_total as 'SALDO TOTAL',
    pagos_vencidos*30 as 'MORA',n_prom as 'TOTAL PROMESA',
    d_prom1 as 'FECHA PROMESA 1',n_prom1 as 'MONTO PROMESA 1',
    d_prom2 as 'FECHA PROMESA 2',n_prom2 as 'MONTO PROMESA 2',
    c_motiv AS 'MOTIVADOR',c_cnp AS 'CAUSA NO PAGO',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'CAMPANA',d_fech AS 'FECHA GESTION',
    max(pagos.fecha) AS 'FECHA PAGO',sum(monto) AS 'MONTO PAGO',max(confirmado) as 'CONFIRMADO'
from resumen join historia on c_cont=id_cuenta
join pagos on numero_de_cuenta=pagos.cuenta and c_cvba=pagos.cliente
where (n_prom>0 or n_prom is null)
and pagos.fecha between :fecha1 and :fecha2
";
        $this->queryBack = "and status_de_credito not like '%tivo' and c_cniv is null
group by resumen.id_cuenta ORDER BY d_fech,c_hrin";
        $data = $this->getHistoria($fecha1, $fecha2, $gestor, $cliente);
        return $data;
    }

    /**
     * 
     * @param string $fecha1
     * @param string $fecha2
     * @param string $gestor
     * @param string $cliente
     * @return array
     */
    public function getBigGestiones($fecha1, $fecha2, $gestor, $cliente) {
        $this->queryFront = "SELECT numero_de_cuenta as 'cuenta',
        nombre_deudor as 'nombre',
    resumen.cliente as 'cliente',status_de_credito as 'segmento',
    saldo_total,status_aarsa as 'mejor status',h1.*,d2.
    v_cc as ponderacion,
    domicilio_deudor as calle,colonia_deudor as 'colonia',
    direccion_nueva as 'direccion nueva',email_deudor,
    pagos.fecha as 'fecha pago',pagos.monto as 'monto pago'
    from resumen join historia h1 on c_cont=resumen.id_cuenta
left join dictamenes d1 on status_aarsa=d1.dictamen
left join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and d2.queue='PAGOS' and fecha between last_day(d_fech-interval 1 month) and d_fech
where d_fech between :fecha1 and :fecha2
";

        $this->queryBack = "";
        $data = $this->getHistoria($fecha1, $fecha2, $gestor, $cliente);
        return $data;
    }

    /**
     * 
     * @param string $fecha1
     * @param string $fecha2
     * @param string $gestor
     * @param string $cliente
     * @return array
     */
    public function getAllGestiones($fecha1, $fecha2, $gestor, $cliente) {
        $this->queryFront = "SELECT numero_de_cuenta,nombre_deudor,
            resumen.cliente,status_de_credito,saldo_total,queue,h1.*
    from resumen join historia h1 on c_cont=id_cuenta
join dictamenes on status_aarsa=dictamen
where d_fech between :fecha1 and :fecha2
";

        $this->queryBack = "and status_de_credito not like '%tivo'
ORDER BY d_fech,c_hrin";
        $data = $this->getHistoria($fecha1, $fecha2, $gestor, $cliente);
        return $data;
    }

    /**
     * 
     * @param string $direction
     * @return array
     */
    public function getGestionDates($direction) {
        $dir = $this->cleanDirection($direction);
        $query = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 5 week)
        ORDER BY d_fech $dir limit 60";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $direction
     * @return array
     */
    public function getPromDates($direction) {
        $dir = $this->cleanDirection($direction);
        $query = "SELECT distinct d_prom FROM historia
        where d_fech>last_day(curdate()-interval 5 week)
        and n_prom > 0
        ORDER BY d_fech $dir limit 60";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $direction
     * @return array
     */
    public function getPagosDates($direction) {
        $dir = $this->cleanDirection($direction);
        $query = "SELECT distinct fecha FROM pagos
        where fecha>last_day(curdate()-interval 2 month)
        ORDER BY fecha $dir limit 60";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getGestionClientes() {
        $query = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        limit 10
	";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getPagosClientes() {
        $query = "SELECT distinct cliente FROM pagos
        where fecha>last_day(curdate()-interval 2 month)
        limit 10
	";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getGestionGestores() {
        $query = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 1000";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getPagosGestores() {
        $query = "SELECT distinct gestor FROM pagos
        where fecha>last_day(curdate()-interval 2 month)
        order by gestor
        limit 1000";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @param array $get
     * @return array
     */
    public function getProms(BigInputObject $bio) {
        $querymain = "select Status_aarsa AS 'STATUS',c_cvge AS 'GESTOR',
    numero_de_cuenta as 'CUENTA',nombre_deudor as 'NOMBRE',
    saldo_descuento_1 as 'SALDO CAPITAL s/i',saldo_total as 'SALDO TOTAL',
    pagos_vencidos*30 as 'MORA',n_prom as 'TOTAL PROMESA',
    d_prom1 as 'FECHA PROMESA 1',n_prom1 as 'MONTO PROMESA 1',
    d_prom2 as 'FECHA PROMESA 2',n_prom2 as 'MONTO PROMESA 2',
    max(folio) AS 'FOLIO',c_motiv AS 'MOTIVADOR',c_cnp AS 'CAUSA NO PAGO',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'CAMPANA',d_fech AS 'FECHA GESTION',
    max(pagos.fecha) AS 'FECHA PAGO',sum(monto) AS 'MONTO PAGO',max(confirmado) as 'CONFIRMADO'
from resumen join historia h1 on c_cont=id_cuenta
left join folios on id=id_cuenta and fecha>=d_fech
left join pagos using (id_cuenta)
where n_prom>0
and d_fech between :fecha1 and :fecha2
and d_prom between :fecha3 and :fecha4
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
" . $bio->getGestorStr() . $bio->getClienteStr() . "
and status_de_credito not like '%tivo' and c_cniv is null
group by id_cuenta ORDER BY d_fech,c_hrin
    ;";
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':fecha1', $bio->getFecha1());
        $stm->bindParam(':fecha2', $bio->getFecha2());
        $stm->bindParam(':fecha3', $bio->getFecha3());
        $stm->bindParam(':fecha4', $bio->getFecha4());
        if ($bio->hasGestor()) {
            $stm->bindParam(':gestor', $bio->getGestor());
        }
        if ($bio->hasCliente()) {
            $stm->bindParam(':cliente', $bio->getCliente());
        }
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}

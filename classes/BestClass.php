<?php

namespace cobra_salsa;

/**
 * Database Queries for 'best' reports
 *
 * @author gmbs
 *
 */
class BestClass extends BaseClass
{

    public function getResumenData() {
        $query = "select ejecutivo_asignado_call_center,numero_de_cuenta,nombre_deudor,
        cliente,status_de_credito,id_cuenta,
        saldo_total,saldo_descuento_1,saldo_descuento_2,
        date(fecha_ultima_gestion) as 'fecha gestion',
        time(fecha_ultima_gestion) as 'hora gestion',
        producto,subproducto,status_aarsa as 'estatus',
        tel_1 as 'tel_casa', tel_2 as 'tel_cel', 
        fecha_de_ultimo_pago, monto_ultimo_pago
        from resumen
        where status_de_credito not regexp '-'
        order by numero_de_cuenta";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getLastHistoriaData($c_cont) {
        $query = "select * from historia
        where c_cont=:c_cont
        order by d_fech desc, c_hrin desc limit 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont);
        $stq->execute();
        $result = $stq->fetchAll();
        return $result;
    }

    /**
     * 
     * @param int $c_cont
     * @return array
     */
    public function getBestHistoriaData($c_cont) {
        $query = "select c_cvst,c_tele,d_fech,c_accion from historia
join dictamenes on c_cvst=dictamen
where c_cont=:c_cont
order by v_cc asc, d_fech desc limit 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont);
        $stq->execute();
        $result = $stq->fetchAll();
        return $result;
    }
    
    /**
     * 
     * @param int $c_cont
     * @return int
     */
    public function countGestiones($c_cont) {
        $query = "select count(1) as ct from historia
where c_cont=:c_cont";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont);
        $stq->execute();
        $result = $stq->fetch();
        return $result['ct'];
    }
}

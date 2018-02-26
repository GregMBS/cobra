<?php

namespace App;

/**
 * Database Queries for 'best' reports
 *
 * @author gmbs
 *
 */
class BestClass extends BaseClass
{

    /**
     * 
     * @return array
     */
    public function getResumenData() {
        $query = "select id_cuenta,numero_de_cuenta,status_de_credito as segmento,
        saldo_total,fecha_ultima_gestion,nombre_deudor,producto,status_aarsa as status_cuenta
        from resumen
        where status_de_credito not regexp '-'
        order by numero_de_cuenta";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param int $c_cont
     * @return array
     */
    public function getLastHistoriaData($c_cont) {
        $query = "SELECT 
            C_CVST as ultimo_status, 
            C_TELE as ultimo_tel, 
            C_OBSE1 as ultimo_comentario 
        FROM historia
        WHERE c_cont=:c_cont
        ORDER BY d_fech DESC, c_hrin DESC LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param int $c_cont
     * @return array
     */
    public function getBestHistoriaData($c_cont) {
        $query = "select c_cvst as mejor_status, c_tele as mejor_tel 
from historia
join dictamenes on c_cvst=dictamen
where c_cont=:c_cont
order by v_cc limit 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}

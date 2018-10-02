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
    private function getResumenData()
    {
        $query = <<<SQL
select id_cuenta,numero_de_cuenta,status_de_credito as segmento,
        saldo_total,fecha_ultima_gestion,nombre_deudor,producto,status_aarsa as status_cuenta
        from resumen
        where status_de_credito not regexp '-'
        order by numero_de_cuenta
SQL;
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return bool|\PDOStatement
     */
    private function prepareLastQuery()
    {
        $query = <<<SQL
SELECT 
            C_CVST as ultimo_status, 
            C_TELE as ultimo_tel, 
            C_OBSE1 as ultimo_comentario 
        FROM historia
        WHERE c_cont=:c_cont
        ORDER BY d_fech DESC, c_hrin DESC LIMIT 1
SQL;
        $stq = $this->pdo->prepare($query);
        return $stq;
    }

    /**
     * @param \PDOStatement $stq
     * @param int $c_cont
     * @return mixed | array
     */
    private function getLastHistoriaData(\PDOStatement $stq, $c_cont)
    {
        $stq->bindParam(':c_cont', $c_cont, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @return bool|\PDOStatement
     */
    private function prepareBestQuery()
    {
        $query = <<<SQL
select c_cvst as mejor_status, c_tele as mejor_tel 
from historia
join dictamenes on c_cvst=dictamen
where c_cont=:c_cont
order by v_cc limit 1
SQL;
        $stq = $this->pdo->prepare($query);
        return $stq;
    }

    /**
     * @param \PDOStatement $stq
     * @param int $c_cont
     * @return mixed | array
     */
    private function getBestHistoriaData(\PDOStatement $stq, $c_cont)
    {
        $stq->bindParam(':c_cont', $c_cont, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param \PDOStatement $lastQuery
     * @param int $id_cuenta
     * @return array|mixed
     */
    private function getUltimo($lastQuery, $id_cuenta) {
        $ultimo = $this->getLastHistoriaData($lastQuery, $id_cuenta);
        if (empty($ultimo)) {
            $ultimo['ultimo_status'] = '';
            $ultimo['ultimo_tel'] = '';
            $ultimo['ultimo_comentario'] = '';
        }
        return $ultimo;
    }

    /**
     * @param \PDOStatement $bestQuery
     * @param int $id_cuenta
     * @return array|mixed
     */
    private function getMejor($bestQuery, $id_cuenta) {
        $mejor = $this->getBestHistoriaData($bestQuery, $id_cuenta);
        if (empty($mejor)) {
            $mejor['mejor_status'] = '';
            $mejor['mejor_tel'] = '';
        }
        return $mejor;
    }

    /**
     * @return array
     */
    public function getReport()
    {
        $data = [];
        $temp = [];
        $resumen = $this->getResumenData();
        $lastQuery = $this->prepareLastQuery();
        $bestQuery = $this->prepareBestQuery();
        if (env('APP_ENV') === 'testing') {
            $temp[] = array_pop($resumen);
            $resumen = $temp;
        }
        foreach ($resumen as $row) {
            $id_cuenta = $row['id_cuenta'];
            $ultimo = $this->getUltimo($lastQuery, $id_cuenta);
            $mejor = $this->getMejor($bestQuery, $id_cuenta);
            $data[] = array_merge($row, $ultimo, $mejor);
        }
        return $data;
    }
}

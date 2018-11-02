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
    private function getDebtorData()
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
     * @param int $id
     * @return mixed | array
     */
    private function getLastHistoryData(\PDOStatement $stq, $id)
    {
        $stq->bindValue(':c_cont', $id, \PDO::PARAM_INT);
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
     * @param int $id
     * @return mixed | array
     */
    private function getBestHistoryData(\PDOStatement $stq, $id)
    {
        $stq->bindValue(':c_cont', $id, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param \PDOStatement $lastQuery
     * @param int $id
     * @return array|mixed
     */
    private function getLatest($lastQuery, $id) {
        $ultimo = $this->getLastHistoryData($lastQuery, $id);
        if (empty($ultimo)) {
            $ultimo['ultimo_status'] = '';
            $ultimo['ultimo_tel'] = '';
            $ultimo['ultimo_comentario'] = '';
        }
        return $ultimo;
    }

    /**
     * @param \PDOStatement $bestQuery
     * @param int $id
     * @return array|mixed
     */
    private function getBest($bestQuery, $id) {
        $best = $this->getBestHistoryData($bestQuery, $id);
        if (empty($best)) {
            $best['mejor_status'] = '';
            $best['mejor_tel'] = '';
        }
        return $best;
    }

    /**
     * @return array
     */
    public function getReport()
    {
        $data = [];
        $temp = [];
        $debtor = $this->getDebtorData();
        $lastQuery = $this->prepareLastQuery();
        $bestQuery = $this->prepareBestQuery();
        if (env('APP_ENV') === 'testing') {
            $temp[] = array_pop($debtor);
            $debtor = $temp;
        }
        foreach ($debtor as $row) {
            if ($row) {
                $id = $row['id_cuenta'];
                $latest = $this->getLatest($lastQuery, $id);
                $best = $this->getBest($bestQuery, $id);
                $data[] = array_merge($row, $latest, $best);
            }
        }
        return $data;
    }
}

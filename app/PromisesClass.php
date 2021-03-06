<?php
namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PDO;

/**
 * Description of PromisesClass
 *
 * @author gmbs
 */
class PromisesClass extends BaseClass
{

    /**
     *
     * @var string
     */
    protected $queryStart = "select resumen.cliente,numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,c_cvge,
status_aarsa,n_prom1,d_prom1,n_prom2,d_prom2,
resumen.id_cuenta,datediff(curdate(),d_prom) as semaforo,d_fech,sum(monto) as sum_monto,
n_prom3,d_prom3,n_prom4,d_prom4,h1.auto
from resumen
join dictamenes on dictamen=status_aarsa
join historia h1 on id_cuenta=c_cont
left join pagos on pagos.id_cuenta=c_cont and fecha>=d_fech
where n_prom>0 and queue in ('CLIENTE NEGOCIANDO','PROMESAS','PAGOS','PAGANDO CONVENIO', 'PROMESAS INCUMPLIDAS')
and status_de_credito not regexp 'inactivo$'
and GREATEST(d_prom1,d_prom2,d_prom3,d_prom4)>last_day(curdate()-interval 1 month - interval 15 day)
and d_fech>last_day(curdate()-interval 2 month)
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
";

    /**
     *
     * @var string
     */
    protected $queryEnd = "group by c_cvge,cliente,status_de_credito,numero_de_cuenta
order by c_cvge,sum(monto),h1.auto
";

    /**
     * 
     * @return string[][]
     */
    private function fromSummary()
    {
        $query = "select cliente,numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,status_aarsa,id_cuenta
from resumen
join dictamenes on dictamen=status_aarsa
where queue in ('CLIENTE NEGOCIANDO','PROMESAS','PAGOS','PAGANDO CONVENIO', 'PROMESAS INCUMPLIDAS')
and status_de_credito not regexp '-'
";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param int $id
     * @param string $date
     * @return float[]
     */
    private function fromPayments($id, $date)
    {
        $query = "SELECT SUM(monto) as sum_monto FROM pagos 
                    WHERE id_cuenta = :id
                    AND fecha >= :date";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':id', $id, PDO::PARAM_INT);
        $stq->bindValue(':date', $date);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     *
     * @param int $id
     * @return string[]
     */
    private function fromHistoryAdmin($id)
    {
        $query = "SELECT c_cvge, n_prom1, d_prom1, n_prom2, d_prom2,
DATEDIFF(CURDATE(),d_prom) AS semaforo, d_fech,
n_prom3, d_prom3, n_prom4, d_prom4
FROM historia h1
WHERE c_cont = :id AND n_prom>0
AND GREATEST(d_prom1,d_prom2,d_prom3,d_prom4)>LAST_DAY(CURDATE()-INTERVAL 1 MONTH - INTERVAL 15 DAY)
AND d_fech>LAST_DAY(CURDATE()-INTERVAL 2 MONTH)
AND NOT EXISTS (
    SELECT * FROM historia h2 WHERE h1.c_cont=h2.c_cont
    AND n_prom>0 AND CONCAT(h2.d_fech,h2.c_hrfi)>CONCAT(h1.d_fech,h1.c_hrfi)
)";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':id', $id, PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
        /**
     * 
     * @param int $id
     * @param string $agent
     * @return string{}
     */
    private function fromHistory($id, $agent)
    {
        $query = "SELECT c_cvge, n_prom1, d_prom1, n_prom2, d_prom2,
DATEDIFF(CURDATE(),d_prom) AS semaforo, d_fech,
n_prom3, d_prom3, n_prom4, d_prom4
FROM historia h1 
WHERE c_cont = :id AND n_prom>0 AND c_cvge = :agent
AND GREATEST(d_prom1,d_prom2,d_prom3,d_prom4)>LAST_DAY(CURDATE()-INTERVAL 1 MONTH - INTERVAL 15 DAY)
AND d_fech>LAST_DAY(CURDATE()-INTERVAL 2 MONTH)
AND NOT EXISTS (
    SELECT * FROM historia h2 WHERE h1.c_cont=h2.c_cont
    AND n_prom>0 AND CONCAT(h2.d_fech,h2.c_hrfi)>CONCAT(h1.d_fech,h1.c_hrfi)
)";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':id', $id, PDO::PARAM_INT);
        $stq->bindValue(':agent', $agent);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $type
     * @param $capt
     * @return array
     */
    public function getPromises($type, $capt)
    {
        $result = [];
        $fromResumen = $this->fromSummary();
        foreach ($fromResumen as $row) {
            $id_cuenta = $row['id_cuenta'];
            if ($type == 'admin') {
                $fromHistory = $this->fromHistoryAdmin($id_cuenta);
            }
            if ($type != 'admin') {
                $fromHistory = $this->fromHistory($id_cuenta, $capt);
            }
            if (!empty($fromHistory)) {
                $d_fech = $fromHistory['d_fech'];
                $fromPagos = $this->fromPayments($id_cuenta, $d_fech);
                $result[] = array_merge($row, $fromHistory, $fromPagos);
            }
        }
        return $result;
    }
}
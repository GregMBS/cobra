<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ResumenObject.php';

/**
 * Description of rotasClass
 *
 * @author gmbs
 */
class RotasClass
{
    protected PDO $pdo;
    protected string $queryRotas = /** @lang text */
        "select c_cont,c_cvge,datediff(curdate(),max(d_prom)) as semaforo,
    max(d_prom1) as dp1, max(n_prom1) as np1, 
    max(d_prom2) as dp2, max(n_prom2) as np2, 
    max(d_prom3) as dp3, max(n_prom3) as np3, 
    max(d_prom4) as dp4, max(n_prom4) as np4, max(d_fech) as fecha 
from resumen
         join dictamenes on dictamen=status_aarsa
         join historia h1 on id_cuenta=c_cont
where n_prom > 0 and queue in ('CLIENTE NEGOCIANDO','PROMESAS','PAGOS','PAGANDO CONVENIO', 'PROMESAS INCUMPLIDAS')
  and status_de_credito not regexp '-'
  and d_prom > last_day(curdate()-interval 1 month - interval 15 day)
  and d_fech > last_day(curdate()-interval 2 month)
  and not exists (select * from historia h2 where h1.c_cont = h2.c_cont
  and n_prom > 0 and concat(h2.d_fech,h2.c_hrfi) > concat(h1.d_fech,h1.c_hrfi))
%s
group by c_cvge, c_cont
order by c_cvge
";

    protected string $queryPagos = "select sum(monto) 
    from pagos
    where id_cuenta = :id_cuenta
    and fecha >= :fecha";

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $capt
     * @return array
     */
    public function getRotas(string $capt): array
    {
        $promesas = $this->buildPromesas($capt);
        return $this->addAccountData($promesas);
    }

    /**
     * @param string $capt
     * @return array
     */
    private function buildPromesas(string $capt): array
    {
        $gestorStr = " and (ejecutivo_asignado_call_center=:capt or c_cvge=:capt) ";
        $tipo = $this->getUserType($capt);
        if ($tipo == 'admin') {
            $gestorStr = "";
        }
        $query = sprintf($this->queryRotas, $gestorStr);
        $stq = $this->pdo->prepare($query);
        if ($tipo != 'admin') {
            $stq->bindParam(':capt', $capt);
        }
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserType($capt)
    {
        $query = "SELECT tipo FROM nombres "
            . "WHERE iniciales = :gestor;";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $capt);
        $stq->execute();
        $types = $stq->fetch();
        return $types['tipo'];
    }

    /**
     * @param array $array
     * @return array
     */
    private function addAccountData(array $array): array
    {
        $result = [];
        foreach ($array as $row) {
            $id_cuenta = $row['c_cont'];
            $fecha = $row['fecha'];
            $account = $this->getAccount($id_cuenta);
            $account['sum_monto'] = $this->getMonto($id_cuenta, $fecha);
            $result[] = array_merge($row, $account);
        }
        return $result;
    }

    /**
     * @param int $id_cuenta
     * @return array
     */
    private function getAccount(int $id_cuenta): array
    {
        $pd = new PdoClass();
        $pdo = $pd->dbConnectNobody();
        $query = "SELECT * FROM resumen WHERE id_cuenta = :id_cuenta";
        $stq = $pdo->prepare($query);
        $stq->bindValue(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id_cuenta
     * @param string $fecha
     * @return float
     */
    private function getMonto(int $id_cuenta, string $fecha): float
    {
        $pd = new PdoClass();
        $pdo = $pd->dbConnectNobody();
        $query = $this->queryPagos;
        $stq = $pdo->prepare($query);
        $stq->bindValue(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stq->bindValue(':fecha', $fecha);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_NUM);
        if (!empty($result[0])) {
            return $result[0];
        }
        return 0;
    }

}
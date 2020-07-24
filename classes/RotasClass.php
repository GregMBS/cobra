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
    protected $pdo;
    protected $queryRotas = "select c_cont,c_cvge,datediff(curdate(),max(d_prom)) as semaforo,
    max(d_fech),sum(monto) as sum_monto
from resumen
         join dictamenes on dictamen=status_aarsa
         join historia h1 on id_cuenta=c_cont
         left join pagos on pagos.id_cuenta=c_cont and fecha>=d_fech
where n_prom>0 and queue in ('CLIENTE NEGOCIANDO','PROMESAS','PAGOS','PAGANDO CONVENIO', 'PROMESAS INCUMPLIDAS')
  and status_de_credito not regexp '-'
  and GREATEST(d_prom1,d_prom2,d_prom3,d_prom4)>last_day(curdate()-interval 1 month - interval 15 day)
  and d_fech>last_day(curdate()-interval 2 month)
  and not exists (select * from historia h2 where h1.c_cont=h2.c_cont
                                              and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
%s
group by c_cvge, c_cont
order by c_cvge, sum(monto)
";


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserType($capt)
    {
        $query = "SELECT tipo FROM nombres "
            ."WHERE iniciales = :gestor;";
        $stq   = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $capt);
        $stq->execute();
        $types = $stq->fetch();
        return $types['tipo'];
    }

    private function buildPromesas(string $capt): array
    {
        $gestorstr = " and (ejecutivo_asignado_call_center=:capt or c_cvge=:capt) ";
        $tipo = $this->getUserType($capt);
        if ($tipo == 'admin') {
            $gestorstr = "";
        }
        $query = sprintf($this->queryRotas, $gestorstr);
        $stq   = $this->pdo->prepare($query);
        if ($tipo != 'admin') {
            $stq->bindParam(':capt', $capt);
        }
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRotas($capt)
    {
        $promesas = $this->buildPromesas($capt);
        return $this->addAccountData($promesas);
    }

    /**
     * @param int $id_cuenta
     * @return ResumenObject
     */
    private function getAccount(int $id_cuenta): ResumenObject
    {
        $pd = new PdoClass();
        $pdo = $pd->dbConnectNobody();
        $query = "SELECT * FROM resumen WHERE id_cuenta = :id_cuenta";
        $stq = $pdo->prepare($query);
        $stq->bindValue(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $result = $stq->fetchObject(ResumenObject::class);
        if ($result) {
            return $result;
        }
        return new ResumenObject();
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
            $account = (array) $this->getAccount($id_cuenta);
            var_dump($row);
            var_dump($account);
            die();
            $result[] = array_merge($row, $account);
        }
        return $result;
    }

}
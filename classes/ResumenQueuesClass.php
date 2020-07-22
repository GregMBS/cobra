<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/QueuelistObject.php';
require_once __DIR__ . '/ResumenObject.php';

/**
 * Description of ResumenQueuesClass
 *
 * @author gmbs
 */
class ResumenQueuesClass
{

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    /**
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @param string $capt
     * @param int $camp
     * @return QueuelistObject
     */
    public function getMyQueue($capt, $camp)
    {
        $query = "SELECT * 
        FROM queuelist 
        WHERE gestor = :capt 
        AND camp= :camp 
        LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':capt', $capt);
        $stq->bindParam(':camp', $camp, PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetchObject(QueuelistObject::class);
        if ($result) {
            return $result;
        }
        return new QueuelistObject();
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    public function getQuickString(int $id_cuenta)
    {
        $queryBase = "SELECT * FROM resumen WHERE id_cuenta = %u LIMIT 1";
        return sprintf($queryBase, $id_cuenta);
    }

    /**
     *
     * @param QueuelistObject $queue
     * @return string
     */
    public function getQueryString(QueuelistObject $queue)
    {
        $clientStr = $queue->getClientString();
        $sdcStr = $queue->getSDCString();
        $crStr = $queue->getCrString();

        switch ($queue->status_aarsa) {

            case 'SIN GESTION':
                $queryBase = "SELECT * FROM resumen 
            WHERE locker is null %s %s 
            AND ((status_aarsa='') or (status_aarsa is null)) 
            ORDER BY saldo_total desc LIMIT 1";
                return sprintf($queryBase, $clientStr, $sdcStr);

            case 'INICIAL':
                $queryBase = "SELECT * FROM resumen
WHERE status_de_credito not regexp '-' 
AND status_aarsa not in ('PAGO TOTAL','PAGO PARCIAL','PAGANDO CONVENIO', 'ACLARACION')
AND ejecutivo_asignado_call_center = %u
AND locker is null 
and fecha_ultima_gestion < curdate()
order by fecha_ultima_gestion  LIMIT 1";
                return sprintf($queryBase, $queue->gestor);

            case 'ESPECIAL':
                $queryBase = "SELECT * FROM resumen
WHERE locker is null %s %s
AND fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day
order by fecha_ultima_gestion  LIMIT 1";
                return sprintf($queryBase, $clientStr, $sdcStr);

            case 'MANUAL':
                $queryBase = "select * from resumen
where locker is null %s %s
and status_aarsa not in (
	select dictamen from dictamenes
	where queue in ('PAGOS','PROMESAS','ACLARACION')
	)
and especial > 0
order by (ejecutivo_asignado_call_center=:capt) desc, especial, saldo_descuento_1 desc limit 1";
                return sprintf($queryBase, $clientStr, $sdcStr);

            default:
                $queryBase = "SELECT * FROM resumen 
join dictamenes on dictamen=status_aarsa 
WHERE locker is null %s %s %s
ORDER BY fecha_ultima_gestion LIMIT 1";
                return sprintf($queryBase, $clientStr, $sdcStr, $crStr);
        }
    }

    /**
     *
     * @param string $sql
     * @return ResumenObject
     */
    public function getAccount(string $sql)
    {
        $stq = $this->pdo->prepare($sql);
        try {
            $stq->execute();
            $result = $stq->fetchObject(ResumenObject::class);
            if ($result) {
                return $result;
            }
            return new ResumenObject();
        } catch (\PDOException $p) {
            die($stq->queryString);
        }
    }
}

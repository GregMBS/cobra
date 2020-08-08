<?php

namespace cobra_salsa;

use Exception;
use PDO;
use PDOException;

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
    private function getMyQueue($capt, $camp)
    {
        $query = "SELECT * 
        FROM queuelist 
        WHERE gestor = :capt 
        AND camp = :camp 
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
     * @param $dictamen
     * @return string
     */
    public function getStatusQueue($dictamen)
    {
        $query = "SELECT queue 
        FROM dictamenes 
        WHERE dictamen = :dictamen
        LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':dictamen', $dictamen);
        $stq->execute();
        $result = $stq->fetchColumn(0);
        if ($result) {
            return $result;
        }
        return '';
    }

    /**
     *
     * @param QueuelistObject $queue
     * @return QueuelistObject
     */
    private function getQueueWithAccounts(QueuelistObject $queue)
    {
        $query = "SELECT queuelist.*
FROM queuelist, dictamenes
WHERE queuelist.status_aarsa = queue
  AND gestor = :capt
  AND bloqueado = 0
  AND (cliente, sdc, dictamen) in (
  select cliente, status_de_credito, status_aarsa 
  from resumen 
  where fecha_ultima_gestion < curdate()
  and locker is null
  )
ORDER BY v_cc desc
LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':capt', $queue->gestor);
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
    private function getQuickString(int $id_cuenta)
    {
        $queryBase = "SELECT * FROM resumen WHERE id_cuenta = %u LIMIT 1";
        return sprintf($queryBase, $id_cuenta);
    }

    /**
     *
     * @param QueuelistObject $queue
     * @return string
     */
    private function getQueryString(QueuelistObject $queue)
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
AND ejecutivo_asignado_call_center = '%s'
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

            default:
                $queryBase = "SELECT resumen.* FROM resumen 
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
     * @throws Exception
     */
    private function getAccount(string $sql)
    {
        $stq = $this->pdo->prepare($sql);
        try {
            $stq->execute();
            $result = $stq->fetchObject(ResumenObject::class);
            if ($result) {
                return $result;
            }
            return new ResumenObject();
        } catch (PDOException $p) {
            throw new Exception($p);
        }
    }

    /**
     * @param string $capt
     * @param int $camp
     * @param $go
     * @param int|null $find
     * @return ResumenObject
     * @throws Exception
     */
    public function getNextAccount(string $capt, int $camp, $go, ?int $find): ResumenObject
    {
        $queue = $this->getMyQueue($capt, $camp);
        $sql = $this->getQueryString($queue);
        $quickArray = ['FromBuscar', 'FromMigo', 'FromUltima', 'FromProm'];
        $quick = in_array($go, $quickArray);
        if ($quick) {
            $sql = $this->getQuickString($find);
        }

        try {
            $row = $this->getAccount($sql);
            if (($row->id_cuenta == 0) && (!$quick)) {
                $queue = $this->getQueueWithAccounts($queue);
                $sql = $this->getQueryString($queue);
                $row = $this->getAccount($sql);
            }
        } catch (Exception $e) {
            throw new Exception($e);
        }
        return $row;
    }

}

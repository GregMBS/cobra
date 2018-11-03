<?php

namespace App;

use Illuminate\Database\Query\Builder;

/**
 * Description of SegmentAdminClass
 *
 * @author gmbs
 */
class SegmentAdminClass extends BaseClass {

    /**
     *
     * @param string $client
     * @param string $segment
     * @return boolean
     * @throws \Exception
     */
	public function eraseSegment($client, $segment) {
	    $qc = new Queuelist();
        /**
         * @var Queuelist $query
         */
	    $query = $qc->whereCliente($client);
	    $query = $query->whereSdc($segment);
	    $result = $query->delete();
		return $result;
	}

	/**
	 *
	 * @param string $client
	 * @param string $segment
	 */
	public function addSegment($client, $segment) {
        $query = <<<SQL
INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :client, status_aarsa, updown1,
            orden1, 9999999, :segment, 0
            FROM queuelist
SQL;
		$stl = $this->pdo->prepare($query);
		$stl->bindValue(':client', $client);
		$stl->bindValue(':segment', $segment);
		$stl->execute();
		$queryUpdateCamp = "update queuelist
            set camp=auto where camp=9999999";
		$this->pdo->query($queryUpdateCamp);
	}

	/**
	 *
	 */
	public function addAllSegments() {
	    /** @var Builder $rc */
	    $rc = new Resumen();
        /**
         * @var Resumen|\Illuminate\Database\Eloquent\Builder $queryCS
         */
        $queryCS = $rc->distinct()->select(['cliente', 'status_de_credito'])
            ->where('status_de_credito', 'NOT REGEXP', '-');
	    $clientSdc = $queryCS->get();
		$query = "INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :cliente, status_aarsa, updown1,
            orden1, 9999999, :segmento, 0
            FROM queuelist";
		$stl = $this->pdo->prepare($query);
		foreach ($clientSdc as $row) {
			$stl->bindValue(':cliente', $row->cliente);
			$stl->bindValue(':segmento', $row->status_de_credito);
			$stl->execute();
		}
		$queryUpdate = "update queuelist
            set camp=auto where camp=9999999";
		$this->pdo->query($queryUpdate);
	}

	/**
	 *
	 * @return array
	 */
	public function listQueuedSegments() {
		$queryTemp = <<<SQL
CREATE TEMPORARY TABLE temporalQueued
SELECT cliente, status_de_credito, COUNT(id_cuenta) AS counter FROM resumen
WHERE status_de_credito NOT REGEXP '-'
GROUP BY cliente, status_de_credito
SQL;
		$this->pdo->query($queryTemp);
		$query = <<<SQL
SELECT q.cliente as 'cliente', sdc, max(r.counter) as cnt, min(q.auto) as id
    FROM queuelist q
    LEFT JOIN temporalQueued r
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc<>'' and q.status_aarsa='sin gestion'
    group by q.cliente,sdc
    
SQL;
		$stq = $this->pdo->query($query);
		$result = $stq->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	/**
	 *
	 * @return array
	 */
	public function listUnqueuedSegments() {
		$queryTemp = "create temporary table temporalUnqueued
select distinct cliente,sdc from queuelist";
		$this->pdo->query($queryTemp);
		$query = "SELECT r.cliente as 'cliente',status_de_credito as 'sdc',
    count(1)
    FROM resumen r
    LEFT JOIN temporalUnqueued q
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc is null
    AND r.cliente <> ''
    AND status_de_credito not regexp '-'
    group by r.cliente,status_de_credito
    ";
		$stq = $this->pdo->query($query);
		$result = $stq->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

    /**
     * inactivate accounts and remove segment from queuelist
     * @param  string $client [client]
     * @param  string $segment [segment]
     * @throws \Exception
     */
	public function inactivateSegment($client, $segment) {
		$query = "update resumen
set status_de_credito = concat(status_de_credito,'-inactivo')
where status_de_credito = :segment
and cliente = :client";
		$stl = $this->pdo->prepare($query);
		$stl->bindValue(':client', $client);
		$stl->bindValue(':segment', $segment);
		$stl->execute();
		$this->eraseSegment($client, $segment);
	}

}

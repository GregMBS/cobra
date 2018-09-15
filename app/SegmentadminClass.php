<?php

namespace App;

/**
 * Description of segmentadminClass
 *
 * @author gmbs
 */
class SegmentadminClass extends BaseClass {

    /**
     *
     * @param string $cliente
     * @param string $segmento
     * @return boolean
     * @throws \Exception
     */
	public function borrarSegmento($cliente, $segmento) {
	    $qc = new Queuelist();
        /**
         * @var Queuelist $query
         */
	    $query = $qc->whereCliente($cliente);
	    $query = $query->whereSdc($segmento);
	    $result = $query->delete();
		return $result;
	}

	/**
	 *
	 * @param string $cliente
	 * @param string $segmento
	 */
	public function agregarSegmento($cliente, $segmento) {
        $query = "INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :cliente, status_aarsa, updown1,
            orden1, 9999999, :segmento, 0
            FROM queuelist";
		$stl = $this->pdo->prepare($query);
		$stl->bindParam(':cliente', $cliente);
		$stl->bindParam(':segmento', $segmento);
		$stl->execute();
		$queryUpdateCamp = "update queuelist
            set camp=auto where camp=9999999";
		$this->pdo->query($queryUpdateCamp);
	}

	/**
	 *
	 */
	public function addAllSegmentos() {
	    $rc = new Resumen();
        /**
         * @var Resumen $queryCS
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
			$stl->bindParam(':cliente', $row->cliente);
			$stl->bindParam(':segmento', $row->status_de_credito);
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
	public function listQueuedSegmentos() {
		$queryTemp = <<<SQL
CREATE TEMPORARY TABLE temporal
SELECT cliente, status_de_credito, COUNT(id_cuenta) AS counter FROM resumen
WHERE status_de_credito NOT REGEXP '-'
GROUP BY cliente, status_de_credito
SQL;
		$this->pdo->query($queryTemp);
		$query = <<<SQL
SELECT q.cliente as 'cliente', sdc, max(r.counter) as cnt, min(q.auto) as id
    FROM queuelist q
    LEFT JOIN temporal r
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc<>'' and q.status_aarsa='sin gestion'
    group by q.cliente,sdc
    
SQL;
		$stq = $this->pdo->query($query);
		$result = $stq->fetchAll(\PDO::FETCH_BOTH);
		return $result;
	}

	/**
	 *
	 * @return array
	 */
	public function listUnqueuedSegments() {
		$queryTemp = "create temporary table temporal
select distinct cliente,sdc from queuelist";
		$this->pdo->query($queryTemp);
		$query = "SELECT r.cliente as 'cliente',status_de_credito as 'sdc',
    count(1)
    FROM resumen r
    LEFT JOIN temporal q
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc is null
    AND r.cliente <> ''
    AND status_de_credito not regexp '-'
    group by r.cliente,status_de_credito
    ";
		$stq = $this->pdo->query($query);
		$result = $stq->fetchAll(\PDO::FETCH_BOTH);
		return $result;
	}

    /**
     * inactivate accounts and remove segment from queuelist
     * @param  string $cliente [description]
     * @param  string $segmento [description]
     * @throws \Exception
     */
	public function inactivarSegmento($cliente, $segmento) {
		$query = "update resumen
set status_de_credito = concat(status_de_credito,'-inactivo')
where status_de_credito = :segmento
and cliente = :cliente";
		$stl = $this->pdo->prepare($query);
		$stl->bindParam(':cliente', $cliente);
		$stl->bindParam(':segmento', $segmento);
		$stl->execute();
		$this->borrarSegmento($cliente, $segmento);
	}

}

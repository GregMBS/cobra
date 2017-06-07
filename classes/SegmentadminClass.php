<?php

namespace cobra_salsa;

/**
 * Description of segmentadminClass
 *
 * @author gmbs
 */
class SegmentadminClass {

    /**
     *
     * @var \PDO
     */
    private $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $cliente
     * @param string $segmento
     */
    public function borrarSegmento($cliente, $segmento) {
        $queryborrar = "DELETE FROM queuelist
            WHERE cliente=:cliente
            AND sdc=:segmento;";
        $stb = $this->pdo->prepare($queryborrar);
        $stb->bindParam(':cliente', $cliente);
        $stb->bindParam(':segmento', $segmento);
        $stb->execute();
    }

    /**
     * 
     * @param string $cliente
     * @param string $segmento
     */
    public function agregarSegmento($cliente, $segmento) {
        $querylistin = "INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :cliente, status_aarsa, updown1,
            orden1, 9999999, :segmento, 0
            FROM queuelist;";
        $stl = $this->pdo->prepare($querylistin);
        $stl->bindParam(':cliente', $cliente);
        $stl->bindParam(':segmento', $segmento);
        $stl->execute();
        $querylistcamp = "update queuelist
            set camp=auto where camp=9999999;";
        $this->pdo->query($querylistcamp);
    }

    /**
     * 
     */
    public function addAllSegmentos() {
        $querycliseg = "SELECT DISTINCT cliente, status_de_credito "
                . "FROM resumen "
                . "WHERE status_de_credito NOT REGEXP '-'";
        $result = $this->pdo->query($querycliseg);
        $querylistin = "INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :cliente, status_aarsa, updown1,
            orden1, 9999999, :segmento, 0
            FROM queuelist";
        $stl = $this->pdo->prepare($querylistin);
        foreach ($result as $row) {
            $stl->bindParam(':cliente', $row['cliente']);
            $stl->bindParam(':segmento', $row['status_de_credito']);
            $stl->execute();
        }
        $querylistcamp = "update queuelist
            set camp=auto where camp=9999999;";
        $this->pdo->query($querylistcamp);
    }

    /**
     * 
     * @return array
     */
    public function listQueuedSegmentos() {
        $querytempr = "create temporary table csdcr
select cliente, status_de_credito, count(id_cuenta) as cnt from resumen
where status_de_credito not regexp '-'
group by cliente, status_de_credito";
        $this->pdo->query($querytempr);
        $querymain = "SELECT q.cliente as 'cliente', sdc, cnt
    FROM queuelist q
    LEFT JOIN csdcr r
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc<>'' and q.status_aarsa='sin gestion'
    group by q.cliente,sdc
    ";
        $result = $this->pdo->query($querymain);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function listUnqueuedSegments() {
        $querytemp = "create temporary table csdc
select distinct cliente,sdc from queuelist";
        $this->pdo->query($querytemp);
        $querymain2 = "SELECT r.cliente as 'cliente',status_de_credito as 'sdc',
    count(1)
    FROM resumen r
    LEFT JOIN csdc q
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc is null
    AND r.cliente <> ''
    AND status_de_credito not regexp '-'
    group by r.cliente,status_de_credito
    ";
        $result = $this->pdo->query($querymain2);
        return $result;
    }

}

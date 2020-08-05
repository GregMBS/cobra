<?php

namespace cobra_salsa;

use PDO;
use PDOException;

class SegmentAdminClass
{

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @param string $cliente
     * @param string $segmento
     */
    public function borrarSegmento($cliente, $segmento)
    {
        $query = "DELETE FROM queuelist
            WHERE cliente=:cliente
            AND sdc=:segmento;";
        $stb = $this->pdo->prepare($query);
        $stb->bindParam(':cliente', $cliente);
        $stb->bindParam(':segmento', $segmento);
        $stb->execute();
    }

    /**
     *
     * @param string $cliente
     * @param string $segmento
     */
    public function agregarSegmento($cliente, $segmento)
    {
        $queryListIn = "INSERT IGNORE INTO queuelist
            (gestor, cliente, status_aarsa, updown1, orden1, camp, sdc,
            bloqueado)
            SELECT distinct gestor, :cliente, status_aarsa, updown1,
            orden1, 9999999, :segmento, 0
            FROM queuelist;";
        $stl = $this->pdo->prepare($queryListIn);
        $stl->bindParam(':cliente', $cliente);
        $stl->bindParam(':segmento', $segmento);
        $stl->execute();
        $queryListCamp = "update queuelist
            set camp=auto where camp=9999999;";
        $this->pdo->query($queryListCamp);
    }

    /**
     *
     */
    public function addAllSegmentos()
    {
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
    public function listQueuedSegmentos()
    {
        $queryDrop = "drop table if exists csdcr";
        $this->pdo->query($queryDrop);
        $queryTemp = "create table csdcr
select cliente, status_de_credito, count(id_cuenta) as cnt from resumen
where status_de_credito not regexp '-'
group by cliente, status_de_credito";
        $this->pdo->query($queryTemp);
        $query = "SELECT q.cliente as 'cliente', sdc, cnt
    FROM queuelist q
    LEFT JOIN csdcr r
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE sdc<>'' and q.status_aarsa='sin gestion'
    and cnt is null
    group by q.cliente,sdc,cnt
    ";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function listUnqueuedSegments()
    {
        $queryDrop = "drop table if exists csdc";
        $queryTemp = "create table csdc
select distinct cliente,sdc from queuelist";
        $query = "SELECT r.cliente as 'cliente',status_de_credito as 'sdc',
    count(1) as 'cnt'
    FROM resumen r
    LEFT JOIN csdc q
    ON q.cliente=r.cliente and sdc=status_de_credito
    WHERE r.cliente <> '' and sdc is null
    AND status_de_credito not regexp '-'
    group by r.cliente,status_de_credito
    having count(1) > 0
    ";
        try {
            $this->pdo->query($queryDrop);
            $this->pdo->query($queryTemp);
            $stm = $this->pdo->prepare($query);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            }
            return [];
        } catch (PDOException $p) {
            die($p->getMessage());
        }
    }

}

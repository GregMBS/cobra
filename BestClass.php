<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database Queries for 'best' reports
 *
 * @author gmbs
 *
 */
class BestClass
{
    /**
     * @var PDO $pdo
     */
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getResumenData()
    {
        $query  = "select id_cuenta,numero_de_cuenta,status_de_credito,
        saldo_total,fecha_ultima_gestion,nombre_deudor,producto,status_aarsa
        from resumen
        where status_de_credito not regexp '-'
        order by numero_de_cuenta";
        $result = $this->pdo->query($query);
        return $result;
    }

    public function getLastHistoriaData($c_cont)
    {
        $query  = "select * from historia
        where c_cont=:c_cont
        order by d_fech desc, c_hrin desc limit 1";
        $stq    = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont);
        $stq->execute();
        $result = $stq->fetchAll();
        return $result;
    }

    public function getBestHistoriaData($c_cont)
    {
        $query  = "select c_cvst,c_tele from historia
join dictamenes on c_cvst=dictamen
where c_cont=:c_cont
order by v_cc limit 1";
        $stq    = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont);
        $stq->execute();
        $result = $stq->fetchAll();
        return $result;
    }
}
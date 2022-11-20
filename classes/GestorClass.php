<?php

namespace cobra_salsa;

use PDO;

/**
 * Description of GestorClass
 *
 * @author gmbs
 */
class GestorClass {

    /**
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $CUENTA
     * @param string $CLIENTE
     * @return array
     */
    public function getPagos(string $CUENTA, string $CLIENTE): array
    {
        $query = "select sum(monto) as sm, max(fecha) as mf 
        from pagos 
        where CUENTA = :cuenta and CLIENTE = :cliente";
        $stp = $this->pdo->prepare($query);
        $stp->bindParam(':cuenta', $CUENTA);
        $stp->bindParam(':cliente', $CLIENTE);
        $stp->execute();
        return $stp->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @return array
     */
    public function getPromsReport(string $gestor): array
    {
        $query = "SELECT d_prom, cuenta, n_prom, c_cvge, 
        ejecutivo_asignado_call_center, status_aarsa, saldo_vencido, 
        cliente,id_cuenta,saldo_descuento_1 
        FROM historia JOIN resumen on c_cont=id_cuenta
        WHERE n_prom>0 AND c_cvge =:gestor 
        AND d_fech > last_day(curdate() - interval 1 month)
        ORDER BY d_prom,cliente,cuenta";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @return array
     */
    public function getOldPromsReport(string $gestor): array
    {
        $query = "SELECT d_prom, cuenta, n_prom, c_cvge, 
        ejecutivo_asignado_call_center, status_aarsa, saldo_vencido, 
        cliente,id_cuenta,saldo_descuento_1 
        FROM historia JOIN resumen on c_cont=id_cuenta
        WHERE n_prom>0 AND c_cvge =:gestor 
        AND d_fech between (last_day(curdate() - interval 2 month) + interval 1 day) and (last_day(curdate() - interval 1 month))
        ORDER BY d_prom,cliente,cuenta";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

}

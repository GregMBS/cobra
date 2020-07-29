<?php

namespace cobra_salsa;

use PDO;

/**
 * Database queries for 'big' reports
 *
 * @author gmbs
 *
 */
class BigClass extends BaseClass {

    /**
     *
     * @var string
     */
    private $queryFront;

    /**
     *
     * @var string
     */
    private $queryBack;

    /**
     *
     * @return array
     */
    public function getGestionClientes() {
        $query = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        limit 10
	";
        $result = $this->pdo->query($query);
        return $result->fetchAll();
    }

    /**
     *
     * @return array
     */
    public function getGestionGestores() {
        $query = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 1000";
        $result = $this->pdo->query($query);
        return $result->fetchAll();
    }

    /**
     *
     * @param BigInputObject $bio
     * @return array
     */
    public function getProms(BigInputObject $bio) {
        $this->queryFront = "SELECT 
    numero_de_cuenta,
    nombre_deudor AS 'NOMBRE',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'SEGMENTO',
    saldo_total,
    saldo_descuento_1,
    saldo_descuento_2,
    queue,
    h1.*,
    v_cc AS 'PONDERACION',
    domicilio_deudor AS 'CALLE',
    colonia_deudor AS 'COLONIA',
    direccion_nueva,
    email_deudor,
    fecha_de_ultimo_pago,
    monto_ultimo_pago
FROM
    resumen
        JOIN
    historia h1 ON c_cont = id_cuenta
		LEFT JOIN
	dictamenes ON status_aarsa = dictamen
WHERE n_prom>0
            and d_fech between :fecha1 and :fecha2
            and d_prom between :fecha3 and :fecha4
            ";
        $this->queryBack = " and status_de_credito not REGEXP '-'
            ORDER BY d_fech,c_hrin";
        $query = $this->queryFront
            . $bio->getGestorStr()
            . $bio->getClienteStr()
            . $this->queryBack;

        $stm = $this->pdo->prepare($query);
        $stm->bindValue(':fecha1', $bio->getFecha1());
        $stm->bindValue(':fecha2', $bio->getFecha2());
        $stm->bindValue(':fecha3', $bio->getFecha3());
        $stm->bindValue(':fecha4', $bio->getFecha4());
        if ($bio->hasGestor()) {
            $stm->bindValue(':gestor', $bio->getGestor());
        }
        if ($bio->hasCliente()) {
            $stm->bindValue(':cliente', $bio->getCliente());
        }
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param BigInputObject $bio
     * @return array
     */
    public function getGestiones(BigInputObject $bio) {
        $this->queryFront = "SELECT 
    numero_de_cuenta,
    nombre_deudor AS 'NOMBRE',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'SEGMENTO',
    saldo_total,
    saldo_descuento_1,
    saldo_descuento_2,
    queue,
    h1.*,
    v_cc AS 'PONDERACION',
    domicilio_deudor AS 'CALLE',
    colonia_deudor AS 'COLONIA',
    direccion_nueva,
    email_deudor,
    fecha_de_ultimo_pago,
    monto_ultimo_pago
FROM
    resumen
        JOIN
    historia h1 ON c_cont = id_cuenta
		LEFT JOIN
	dictamenes ON status_aarsa = dictamen
WHERE d_fech between :fecha1 and :fecha2
            ";
        $this->queryBack = " and status_de_credito not REGEXP '-'
            ORDER BY d_fech,c_hrin";
        $query = $this->queryFront
            . $bio->getGestorStr()
            . $bio->getClienteStr()
            . $this->queryBack;

        $stm = $this->pdo->prepare($query);
        $stm->bindValue(':fecha1', $bio->getFecha1());
        $stm->bindValue(':fecha2', $bio->getFecha2());
        if ($bio->hasGestor()) {
            $stm->bindValue(':gestor', $bio->getGestor());
        }
        if ($bio->hasCliente()) {
            $stm->bindValue(':cliente', $bio->getCliente());
        }
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}

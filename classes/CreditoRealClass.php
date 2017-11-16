<?php

namespace cobra_salsa;

class CreditoRealClass extends BaseClass {

    /**
     *
     * @var array
     */
    private $keys = array('d_fech', 'despacho',
        'numero_de_credito', 'numero_de_cuenta',
        'actCode', 'resCode', 'statCode', 'gestion');

    /**
     *
     * @var array
     */
    private $columnNames = array(
        'fecha de gestion',
        'agencia',
        'numero_solicitud',
        'num_operacion',
        'acción',
        'resultado',
        'motivo',
        'comentario'
    );

    /**
     *
     * @var array
     */
    private $resCode = array(
        'ACLARACION' => 'CT',
        'CAMBIO DE DOMICILIO' => 'CR',
        'CLIENTE FALLECIDO' => 'CR',
        'CLIENTE NEGOCIANDO' => 'CT',
        'CONFIRMA PROMESA' => 'CT',
        'ILOCALIZABLE EN EL DOMICILIO' => 'IL',
        'ILOCALIZABLE TELEFONICO' => 'IL',
        'MENSAJE CON FAMILIAR' => 'CR',
        'MENSAJE CON TERCERO' => 'CR',
        'MENSAJE CON VECINO' => 'CR',
        'MENSAJE EN CONTESTADORA' => 'IL',
        'NEGATIVA DE PAGO' => 'CT',
        'NOTIFICACION A FAMILIAR' => 'CR',
        'NOTIFICACION A TERCERO' => 'CR',
        'NOTIFICACION BAJO PUERTA' => 'IL',
        'PAGO PARCIAL' => 'CT',
        'PAGO TOTAL' => 'CT',
        'PROMESA DE PAGO' => 'CT',
        'PROMESA DE PAGO PARCIAL' => 'CT',
        'PROMESA DE PAGO TOTAL' => 'CT',
        'TEL NO CONTESTA' => 'IL',
        'TEL NO EXISTE' => 'IL',
        'TEL OCUPADA' => 'IL',
        'TEL SUSPENDIDO' => 'IL',
        'TERCERO NO CONOCE DEUDOR' => 'CR',
    );
    private $statCode = array(
        'ACLARACION' => 'NG',
        'CAMBIO DE DOMICILIO' => 'DH',
        'CLIENTE FALLECIDO' => 'DF',
        'CLIENTE NEGOCIANDO' => 'PP',
        'CONFIRMA PROMESA' => 'PA',
        'ILOCALIZABLE EN EL DOMICILIO' => 'AE',
        'ILOCALIZABLE TELEFONICO' => 'NA',
        'MENSAJE CON FAMILIAR' => 'DM',
        'MENSAJE CON TERCERO' => 'DM',
        'MENSAJE CON VECINO' => 'DM',
        'MENSAJE EN CONTESTADORA' => 'DM',
        'NEGATIVA DE PAGO' => 'NG',
        'NOTIFICACION A FAMILIAR' => 'EN',
        'NOTIFICACION A TERCERO' => 'EN',
        'NOTIFICACION BAJO PUERTA' => 'EN',
        'PAGO PARCIAL' => 'PH',
        'PAGO TOTAL' => 'LD',
        'PROMESA DE PAGO' => 'PP',
        'PROMESA DE PAGO PARCIAL' => 'PP',
        'PROMESA DE PAGO TOTAL' => 'PP',
        'TEL NO CONTESTA' => 'NA',
        'TEL NO EXISTE' => 'NA',
        'TEL OCUPADA' => 'NA',
        'TEL SUSPENDIDO' => 'NA',
        'TERCERO NO CONOCE DEUDOR' => 'NK',
    );

    /**
     *
     * @var array 
     */
    private $actCode = array(
        'CLIENTE NOS LLAMO' => 'VI',
        'CLIENTE SE PRESENTO ' => 'VI',
        'LLAMADA A DOMICILIO' => 'VO',
        'LLAMADA A REFERENCIA' => 'VO',
        'LLAMADA A TRABAJO' => 'VO',
        'VISITA A DOMICILIO' => 'VP',
        'VISITA A REFERENCIA' => 'VP',
        'VISITA A TRABAJO' => 'VL',
        'LLAMADA A CELULAR' => 'VO'
    );

    /**
     * 
     * @param string $act
     * @return string
     */
    private function getAccionCode($act) {
        return $this->actCode[$act];
    }

    /**
     * 
     * @param string $stat
     * @return string
     */
    private function getResultCode($stat) {
        return $this->resCode[$stat];
    }

    /**
     * 
     * @param string $stat
     * @return string
     */
    private function getStatusCode($stat) {
        return $this->statCode[$stat];
    }

    /**
     * 
     * @return string
     */
    private function getStartDate() {
//        $startDate = "select greatest(
//date_sub(curdate()-1, interval (WEEKDAY(curdate()-1)) day),
//date_sub(curdate()-1, interval (WEEKDAY(curdate()-3)) day),
//date_sub(curdate()-1, interval (WEEKDAY(curdate()-5)) day)
//)";
//        $std = $this->pdo->query($startDate);
//        $result = $std->fetch();
//        return $result[0];
        return date('Y-m-01');
    }

    /**
     * 
     * @return array
     */
    private function getFromCobra() {
        $start = $this->getStartDate();
        $querymain = "SELECT fecha_de_asignacion, d_fech,
            numero_de_credito, numero_de_cuenta, producto, c_accion,
            c_cvst, left(c_obse1,199) as gestion from resumen, historia 
    where id_cuenta=c_cont and status_de_credito not like '%inactivo' 
    and cliente = 'Credito Real' and d_fech >= :start and d_fech <= curdate()
ORDER BY d_fech, c_hrin";
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':start', $start);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    private function getMonthlyFromCobra() {
        $start = $this->getStartDate();
        $querymain = "SELECT fecha_de_asignacion, d_fech,
            numero_de_credito, numero_de_cuenta, producto, c_accion,
            c_cvst, left(c_obse1,199) as gestion from resumen, historia 
    where id_cuenta=c_cont  
    and cliente = 'Credito Real' and d_fech > last_day(curdate() - interval 6 week) and d_fech <= last_day(curdate() - interval 2 week)
ORDER BY d_fech, c_hrin";
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':start', $start);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $c_cvst
     * @return boolean
     */
    private function checkstat($c_cvst) {
        $stats = array_keys($this->resCode);
        $good = in_array($c_cvst, $stats);
        return $good;
    }

    private function loadArray($inrow) {
        $outrow = array();
        foreach ($this->keys as $key) {
            $outrow[] = $inrow[$key];
        }
        return $outrow;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    private function addSpecialData($data) {
        $output = array();
        foreach ($data as $row) {
            $good = $this->checkstat($row['c_cvst']);
            if ($good) {
                $inrow = $row;
                $inrow['despacho'] = 'PAVE';
                $inrow['actCode'] = $this->getAccionCode($row['c_accion']);
                $inrow['resCode'] = $this->getResultCode($row['c_cvst']);
                $inrow['statCode'] = $this->getStatusCode($row['c_cvst']);
                $outrow = $this->loadArray($inrow);
                $output[] = $outrow;
            }
        }
        return $output;
    }

    /**
     * 
     * @return array
     */
    public function outputReport() {
        $cobra = $this->getFromCobra();
        $data = $this->addSpecialData($cobra);
        $columns = $this->columnNames;
        $output = array('headers' => $columns, 'data' => $data);
        return $output;
    }

    /**
     * 
     * @return array
     */
    public function outputMonthlyReport() {
        $cobra = $this->getMonthlyFromCobra();
        $data = $this->addSpecialData($cobra);
        $columns = $this->columnNames;
        $output = array('headers' => $columns, 'data' => $data);
        return $output;
    }

}

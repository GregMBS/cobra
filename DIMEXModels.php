<?php

class DIMEXModels
{
    private $con;
    private $columnNames = array(
        'Núm. De Crédito',
        'Nombre',
        'Saldo Total',
        'Gestor',
        'Cod. Resultado',
        'Fecha Gestión',
        'Hora de Gestión',
        'Comentario',
        'Fecha de Promesa',
        'Cantidad de Promesa',
        'INTENTOS',
        'CNT',
        'RPC',
        'PTP'
    );
    private $statusCode = array(
        'ACLARACION' => '*ACLARACION DE PAGO ',
        'CLIENTE FALLECIDO' => '*CLIENTE FALLECIDO',
        'CLIENTE NEGOCIANDO' => '*CLIENTE NEGOCIANDO ',
        'CONFIRMA PROMESA' => '*CONFIRMA PROMESA',
        'MENSAJE CON FAMILIAR' => '*MENSAJE CON FAMILIAR ',
        'MENSAJE CON TERCERO' => '*MENSAJE CON TERCERO ',
        'MENSAJE EN CONTESTADORA' => '*MENSAJE EN BUZON',
        'NEGATIVA DE PAGO' => '*NEGATIVA DE PAGO',
        'PAGANDO CONVENIO' => '*PAGO PARCIAL',
        'PAGO PARCIAL' => '*PAGO PARCIAL',
        'PAGO TOTAL' => '*PAGO TOTAL',
        'PROMESA DE PAGO PARCIAL' => '*PROMESA DE PAGO PARCIAL',
        'PROMESA DE PAGO TOTAL' => '*PROMESA DE PAGO TOTAL',
        'TEL NO CONTESTA' => '*TELEFONO NO CONTESTA      ',
        'TEL NO EXISTE' => '*TELEFONO NO EXISTE',
        'TEL OCUPADA' => '*TELEFONO NO CONTESTA      ',
        'TEL SUSPENDIDO' => '*TELEFONO SUSPENDIDO',
        'TERCERO NO CONOCE DEUDOR' => '*TERCERO DICE NO CONOCER A CLIENTE '
    );

    public function __construct()
    {
        require_once 'PdoClass.php';
        $db        = new PdoClass();
        $this->con = $db->getDB();
    }

    private function getStatusCode($key) {
     if (isset($this->statusCode[$key])) {
         return $this->statusCode[$key];
     } else {
         return '';
     }
    }

    private function getFromCobra()
    {
        $querymain = "select numero_de_cuenta, nombre_deudor, saldo_total,
            completo, c_cvst, d_fech,
            c_hrin, c_obse1, d_prom,
            n_prom, 1 as INTENTOS, (c_carg <> '') as CNT,
            (c_carg = 'deudor') as RPC, (n_prom > 0) as PTP
            from resumen, historia, nombres
            where c_cvge = iniciales
            and c_cont = id_cuenta
            and cliente = 'DIMEX';
            ";
        $result    = $this->con->query($querymain);
        return $result;
    }

    private function addSpecialData($data)
    {
        $output = array();
        foreach ($data as $row) {
            $inrow           = $row;
            $inrow['c_cvst'] = $this->getStatusCode($row['c_cvst']);
            foreach ($this->keys as $key) {
                $outrow[] = $inrow[$key];
            }
            if (!empty($outrow['c_cvst'])) {
                $output[] = $outrow;
            }
        }
        return $output;
    }

    public function outputReport()
    {
        $cobra   = $this->getFromCobra();
        $data    = $this->addSpecialData($cobra);
        $columns = $this->columnNames;
        $output  = array('headers' => $columns, 'data' => $data);
        return $output;
    }
}
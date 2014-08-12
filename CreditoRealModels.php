<?php

class CreditoRealModels {

    private $con;
    private $keys = array('fecha_de_asignacion', 'd_fech', 'despacho',
        'numero_de_credito', 'numero_de_cuenta', 'producto',
        'actCode', 'actDesc', 'class', 'classDesc',
        'class1', 'class1Desc', 'gestion');
    private $columnNames = array(
        'Fecha Asignación',
        'Fecha Gestión',
        'Agencia',
        'numero_solicitud',
        'num_operacion',
        'Nom Distribuidor',
        'Acción',
        'Descripción Acción',
        'Class',
        'Descripción Class',
        'Class 1',
        'Descripción Class 1',
        'Comentario (Máx 200 caracteres)'
    );
    private $class = array(
        'ACLARACION' => 'B1',
        'ACTUALIZACION DE DATOS' => 'M1',
        'CAMBIO DE DOMICILIO' => 'M1',
        'CLIENTE FALLECIDO' => 'M1',
        'CLIENTE NEGOCIANDO' => 'M1',
        'CONFIRMA PROMESA' => 'M1',
        'ILOCALIZABLE DEFINITIVO' => 'U1',
        'ILOCALIZABLE ELECTRONICO' => 'U1',
        'ILOCALIZABLE EN EL DOMICILIO' => 'U1',
        'ILOCALIZABLE TELEFONICO' => 'U1',
        'INSOLVENTE' => 'N1',
        'MENSAJE CON FAMILIAR' => 'M1',
        'MENSAJE CON TERCERO' => 'M1',
        'MENSAJE EN CONTESTADORA' => 'M1',
        'MERCANCIA ENTREGADA' => 'P1',
        'NEGATIVA DE PAGO' => 'N1',
        'NOTIFICACION A FAMILIAR' => 'M1',
        'NOTIFICACION A TERCERO' => 'M1',
        'NOTIFICACION BAJO PUERTA' => 'U1',
        'PAGANDO CONVENIO' => 'P1',
        'PAGO DE CONVENIO' => 'P1',
        'PAGO DEL MES ANTERIOR' => 'B1',
        'PAGO INCOMPLETO' => 'B1',
        'PAGO PARCIAL' => 'P1',
        'PAGO TOTAL' => 'P1',
        'PARA DEMANDA' => 'B1',
        'PROCESOS MASIVOS' => 'S1',
        'PROMESA DE PAGO PARCIAL' => 'U1',
        'PROMESA DE PAGO TOTAL' => 'U1',
        'PROMESA INCUMPLIDA' => 'ES',
        'TEL NO CONTESTA' => 'U1',
        'TEL NO EXISTE' => 'U1',
        'TEL OCUPADA' => 'U1',
        'TEL SUSPENDIDO' => 'U1',
        'TERCERO NO CONOCE DEUDOR' => 'U1',
        'VIVIENDA ABANDONADA' => 'U1',
        'VIVIENDA DESHABITADA' => 'U1',
        'VIVIENDA INVADIDA' => 'U1',
        'VIVIENDA INVALIDA' => 'U1',
        'VIVIENDA RENTADA' => 'U1'
    );
    private $classDesc = array(
        'P1' => 'PROMESA DE PAGO',
        'N1' => 'NEGATIVA DE PAGO ',
        'ES' => 'COMENTARIO',
        'B1' => 'POSIBLE ACLARACION ',
        'F1' => 'ENVIO GENERAL',
        'S1' => 'PROCESOS MASIVOS',
        'U1' => 'SIN CONTACTO',
        'M1' => 'MENSAJE'
    );
    private $class1 = array(
        'ACLARACION' => 'B16',
        'ACTUALIZACION DE DATOS' => 'M15',
        'CAMBIO DE DOMICILIO' => 'M15',
        'CLIENTE FALLECIDO' => 'B10',
        'CLIENTE NEGOCIANDO' => 'ES',
        'CONFIRMA PROMESA' => 'P13',
        'ILOCALIZABLE DEFINITIVO' => 'ES',
        'ILOCALIZABLE ELECTRONICO' => 'ES',
        'ILOCALIZABLE EN EL DOMICILIO' => 'ES',
        'ILOCALIZABLE TELEFONICO' => 'ES',
        'INSOLVENTE' => 'N14',
        'MENSAJE CON FAMILIAR' => 'M10',
        'MENSAJE CON TERCERO' => 'M11',
        'MENSAJE EN CONTESTADORA' => 'M12',
        'MERCANCIA ENTREGADA' => 'P12',
        'NEGATIVA DE PAGO' => 'N16',
        'NOTIFICACION A FAMILIAR' => 'M16',
        'NOTIFICACION A TERCERO' => 'M14',
        'NOTIFICACION BAJO PUERTA' => 'U18',
        'PAGANDO CONVENIO' => 'P12',
        'PAGO DE CONVENIO' => 'P12',
        'PAGO DEL MES ANTERIOR' => 'P12',
        'PAGO INCOMPLETO' => 'ES',
        'PAGO PARCIAL' => 'P12',
        'PAGO TOTAL' => 'P12',
        'PARA DEMANDA' => 'B12',
        'PROCESOS MASIVOS' => 'F1',
        'PROMESA DE PAGO PARCIAL' => 'P11',
        'PROMESA DE PAGO TOTAL' => 'P13',
        'PROMESA INCUMPLIDA' => 'ES',
        'TEL NO CONTESTA' => 'U10',
        'TEL NO EXISTE' => 'U15',
        'TEL OCUPADA' => 'U11',
        'TEL SUSPENDIDO' => 'U11',
        'TERCERO NO CONOCE DEUDOR' => 'U12',
        'VIVIENDA ABANDONADA' => 'U16',
        'VIVIENDA DESHABITADA' => 'U16',
        'VIVIENDA INVADIDA' => 'U16',
        'VIVIENDA INVALIDA' => 'U19',
        'VIVIENDA RENTADA' => 'M16'
    );
    private $class1Desc = array(
        'P11' => 'PAGO PARCIAL',
        'P12' => 'PAGO YA EFECTUADO',
        'P13' => 'CONVENIO PARA LIQUIDAR (Con ó Sin Dscto)',
        'N10' => 'INSOLVENCIA POR DESEMPLEO',
        'N11' => 'INSOLVENCIA POR INVALIDEZ',
        'N12' => 'INSOLVENCIA POR ENFERMEDAD',
        'N13' => 'INSOLVENCIA OTROS GASTOS',
        'N14' => 'INSOLVENCIA OTRAS DEUDAS',
        'N15' => 'NEGLIGENCIA PRESTANOMBRE',
        'N16' => 'NEGLIGENCIA',
        'E10' => ' ',
        'B10' => 'CANCELACIÓN DE CUENTA POR DEFUNCIÓN',
        'B11' => 'CARTA DE NO ADEUDO',
        'B12' => 'FRAUDE ATRIBUIBLE AL CLIENTE',
        'B13' => 'FRAUDE NO ATRIBUIBLE POR EL CLIENTE',
        'B14' => 'MODIFICACIÓN DE BURÓ DE CRÉDITO',
        'B15' => 'PAGOS PARCIALES SIN APLICAR',
        'B16' => 'PAGOS PARA LIQUIDAR SIN APLICAR',
        'F1' => 'ENVIO GENERAL',
        'F11' => 'ROBOT O BLASTER',
        'F12' => 'SMS',
        'F13' => 'CARTA',
        'F14' => 'MAIL',
        'U10' => 'NO CONTESTAN',
        'U11' => 'TELEFONO OCUPADO/FDS/FAX',
        'U12' => 'TELEFONO EQUIVOCADO',
        'U13' => 'LO CONOCEN PERO NO QUIEREN DAR DATOS',
        'U14' => 'COLGADA',
        'U15' => 'TELEFONO NO EXISTE',
        'U16' => 'TT NUNCA HABITO EL  DOMICILIO (VISITA)',
        'U17' => 'TT NUNCA LABORO EN LA EMPRESA (VISITA)',
        'U18' => 'SE DEJA NOTIFICACIÓN BAJO PUERTA',
        'U19' => 'NO EXISTE EL DOMICILIO',
        'M10' => 'MENSAJE CON FAMILIAR ',
        'M11' => 'MENSAJE CON TERCERO O REFERENCIA',
        'M12' => 'MENSAJE EN CONTESTADORA',
        'M13' => 'MENSAJE EN OFICINA',
        'M14' => 'SE DEJA NOTIFICACION DE PAGO CON 3°',
        'M15' => 'TT YA NO HABITA EL DOMICILIO, MENSAJE CON FAMILIAR',
        'M16' => 'TT RENTABA, YA NO HABITA EL DOMICILIO'
    );
    private $actCode = array(
        'CLIENTE NOS LLAMO' => 'DT',
        'CLIENTE SE PRESENTO ' => 'HR',
        'LLAMADA A DOMICILIO' => 'TD',
        'LLAMADA A REFERENCIA' => 'TO',
        'LLAMADA A TRABAJO' => 'TE',
        'SE MANDO CARTEO' => 'HR',
        'SE MANDO ROBOT' => 'HR',
        'VISITA A DOMICILIO' => 'VP',
        'VISITA A REFERENCIA' => 'VR',
        'VISITA A TRABAJO' => 'VE',
        'LLAMADA A CELULAR' => 'TC',
        'EMAIL A TRABAJO' => 'HR',
        'EMAIL A DOMICILIO' => 'HR',
        'SUPERVISION' => 'HR'
    );
    private $actDesc = array(
        'TE' => 'Tel empleo',
        'TD' => 'Tel domicilio',
        'TC' => 'tel movil',
        'TO' => 'Tel Otro',
        'DT' => 'Cliente telefonea',
        'VP' => 'Visita Principal',
        'VE' => 'Visita Empleo',
        'VR' => 'Visita Referencias',
        'VO' => 'Visita otros domicilios',
        'HR' => 'Herramientas'
    );

    function __construct() {
        require_once 'PdoClass.php';
        $db = new PdoClass();
        $this->con = $db->getDB();
    }

    private function getAccionCode($act) {
        return $this->actCode[$act];
    }

    private function getActDesc($code) {
        return $this->actDesc[$code];
    }

    private function getClass($cvst) {
        return $this->class[$cvst];
    }

    private function getClassDesc($class) {
        return $this->classDesc[$class];
    }

    private function getClass1($cvst) {
        return $this->class1[$cvst];
    }

    private function getClass1Desc($class1) {
        return $this->class1Desc[$class1];
    }

    private function getStartDate() {
        $startDate = "select greatest(
date_sub(curdate()-1, interval (WEEKDAY(curdate()-1)) day),
date_sub(curdate()-1, interval (WEEKDAY(curdate()-3)) day),
date_sub(curdate()-1, interval (WEEKDAY(curdate()-5)) day)
)";
        $std = $this->con->query($startDate);
        $result = $std->fetch();
//        return $result[0];
	return date('Y-m-01');
    }

    private function getFromCobra() {
        $querymain = "SELECT fecha_de_asignacion, d_fech,
            numero_de_credito, numero_de_cuenta, producto, c_accion,
            c_cvst, left(c_obse1,199) as gestion from resumen, historia 
    where id_cuenta=c_cont and status_de_credito not like '%inactivo' 
    and cliente = 'Credito Real' and d_fech >= :start and d_fech <= curdate()
ORDER BY d_fech, c_hrin";
        $stm = $this->con->prepare($querymain);
        $stm->bindParam(':start', $this->getStartDate());
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getMonthlyFromCobra() {
        $querymain = "SELECT fecha_de_asignacion, d_fech,
            numero_de_credito, numero_de_cuenta, producto, c_accion,
            c_cvst, left(c_obse1,199) as gestion from resumen, historia 
    where id_cuenta=c_cont and status_de_credito not like '%inactivo' 
    and cliente = 'Credito Real' and d_fech > last_day(curdate() - interval 5 week) and d_fech <= last_day(curdate() - interval 1 week)
ORDER BY d_fech, c_hrin";
        $stm = $this->con->prepare($querymain);
        $stm->bindParam(':start', $this->getStartDate());
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    private function addSpecialData($data) {
        $output = array();
        foreach ($data as $row) {
            $inrow = $row;
            $inrow['despacho'] = 'CSI';
            $inrow['actCode'] = $this->getAccionCode($row['c_accion']);
            $inrow['actDesc'] = $this->getActDesc($inrow['actCode']);
            $inrow['class'] = $this->getClass($row['c_cvst']);
            $inrow['classDesc'] = $this->getClassDesc($inrow['class']);
            $inrow['class1'] = $this->getClass1($row['c_cvst']);
            $inrow['class1Desc'] = $this->getClass1Desc($inrow['class1']);
            $outrow = array();
            foreach ($this->keys as $key) {
                $outrow[] = $inrow[$key];
            }
            $output[] = $outrow;
        }
        return $output;
    }

    public function outputReport() {
        $cobra = $this->getFromCobra();
        $data = $this->addSpecialData($cobra);
        $columns = $this->columnNames;
        $output = array('headers' => $columns, 'data' => $data);
        return $output;
    }

    public function outputMonthlyReport() {
        $cobra = $this->getMonthlyFromCobra();
        $data = $this->addSpecialData($cobra);
        $columns = $this->columnNames;
        $output = array('headers' => $columns, 'data' => $data);
        return $output;
    }

}

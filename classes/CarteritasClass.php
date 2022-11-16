<?php

namespace cobra_salsa;

use DateTimeImmutable;
use Exception;

require_once 'InputClass.php';
require_once 'CarteritasObject.php';

class CarteritasClass extends BaseClass
{
    /**
     * @var string
     */
    public string $fix_visitas = <<<'EOV'
    update cobraribemi.historia,cobraribemi.resumen
    set c_cont=id_cuenta,c_cvba=cliente,fecha_ultima_gestion=now()
    where c_cont = 0
    and cuenta = numero_de_cuenta
    and cliente in ('banco azteca','FAMSA');
EOV;

    /**
     * @var string
     */
    public string $fix_tels = <<<'EOT'
    update cobraribemi.historia
    set c_tele=c_ntel
    where c_tele is null and c_ntel <> '';
    EOT;

    /**
     * @var string
     */
    public string $fix_proms = <<<'EOP'
    update cobraribemi.historia,cobraribemi.resumen
    set n_prom=saldo_descuento_2,
        n_prom1=saldo_descuento_2,
        D_PROM=d_fech+interval 7 day,
        D_PROM1=d_fech+interval 7 day
                where c_cvst like 'Promesa de pago total'
    and n_prom is null
    and c_obse2 is null
    and c_cont=id_cuenta;
    EOP;

    /**
     * @var array
     */
    private array $status = ['Nunca vivio en el domicilio' => 'TERCERO NO CONOCE DEUDOR',
          'Deudor ya no vive en el domicilio' => 'TERCERO NO CONOCE DEUDOR',
          'Promesa de pago' => 'PROMESA DE PAGO TOTAL',
          'Se confirma que el deudor vive en el domicilio' => 'NOTIFICACION A TERCERO',
          'Mensaje con terceros' => 'NOTIFICACION A TERCERO',
          'Se cambio de domicilio' => 'NOTIFICACION A FAMILIAR',
          'Recado con familiar' => 'NOTIFICACION A FAMILIAR',
          'Finado' => 'CLIENTE FALLECIDO',
          'Cliente fallecido' => 'CLIENTE FALLECIDO',
          'Cliente fallecido sin evidencia' => 'CLIENTE FALLECIDO',
          'Finado sin evidencia' => 'CLIENTE FALLECIDO',
          'Disminucion de ingresos' => 'CLIENTE NEGOCIANDO',
          'Se entrego notificación' => 'NOTIFICACION BAJO PUERTA',
          'Aviso debajo de la puerta' => 'NOTIFICACION BAJO PUERTA',
          'Radica en el extranjero' => 'TITULAR RADICA EN EL EXTRAJERO',
          'Desempleo' => 'NEGATIVO DE PAGO',
'CLIENTE FALLECIDO' => 'CLIENTE FALLECIDO',
'CLIENTE NEGOCIANDO' => 'CLIENTE NEGOCIANDO',
'MENSAJE CON FAMILIAR' => 'MENSAJE CON FAMILIAR',
'MENSAJE CON TERCERO' => 'MENSAJE CON TERCERO',
'MENSAJE FAMILIAR' => 'MENSAJE FAMILIAR',
'NEGATIVA DE PAGO' => 'NEGATIVA DE PAGO',
'NEGOCIANDO' => 'NEGOCIANDO',
'NO CONOCEN A TERCERO' => 'NO CONOCEN A TERCERO',
'NO CONTESTA' => 'NO CONTESTA',
'NO CONTESTAN' => 'NO CONTESTAN',
'PAGO PARCIAL' => 'PAGO PARCIAL',
'PAGO TOTAL' => 'PAGO TOTAL',
'PROMESA DE PAGO PARCIAL' => 'PROMESA DE PAGO PARCIAL',
'TERCERO NO CONOCE A TT' => 'TERCERO NO CONOCE A TT',
'VALIDACION' => 'VALIDACION',
          'Se niega a pagar/Sin voluntad de pago' => 'NEGATIVO DE PAGO'];

    /**
     * @param string $string
     * @return string
     */
    private function getFirstWord(string $string): string
    {
        $array = explode(' ', trim($string));
        if (empty($array[0])) {
            return '';
        }
        return $array[0];
    }

    private function getTelCom(string $string, string $backup): array
    {
        $output['tel']='';
        $output['com'] = $string;
        $telTemp = $this->getFirstWord(trim($string));
        if (is_numeric($telTemp)) {
            $output['tel'] = $telTemp;
            $output['com'] = $this->getOtherWords($string, $backup);
        }
        if (empty($output['com'])) {
            $output['com'] = $backup;
        }
        return $output;
    }

    /**
     * @param string $string
     * @param string $backup
     * @return string
     */
    private function getOtherWords(string $string, string $backup): string
    {
        $array = explode(' ', trim($string), 2);
        if (empty($array[1])) {
            return trim($backup);
        }
        return $array[1];
    }

    /**
     * @param string $string
     * @return string
     */
    private function getStatus(string $string): string
    {
        $result = $this->getOtherWords($string, $string . $string);
        if (isset($this->status[$result])) {
            return $this->status[$result];
        }
        return $string;
    }

    /**
     *
     * @return string
     */
    public function moveLoadedFile(): string
    {
        $destination = "/tmp/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
        return $destination;
    }

    /**
     * @param array $data
     * @return string
     */
    private function loadVisitas(array $data): string
    {
        $header = /** @lang Text */ "INSERT INTO historia
    (c_visit,c_cvge,c_ntel,cuenta,c_obse1,d_fech,c_cvst,c_hrin,c_hrfi,c_accion,c_cniv) VALUES  ";
        $sql = $header;
        foreach ($data as $row) {
            $f = $this->getFirstWord($row[2]);
            $tc = $this->getTelCom($row[5], $row[4]);
            $t = $tc['tel'];
            $a = trim($row[0]);
            $c = $tc['com'];
            /** @var DateTimeImmutable $fechaHora */
            $fechaHora = $row[3];
            $fe = $fechaHora->format('Y-m-d');
            $s = $this->getStatus($row[4]);
            $h = $fechaHora->format('H:i:s');
            $temp = ("\n('" . $f . "','" . $f . "','" . $t . "','" . $a
                . "','" . $c . "','" . $fe . "','" . $s . "','" . $h .
                "','00:00:00','VISITA A DOMICILIO','planta baja'),");
            $sql .= $temp;
        }
        return rtrim($sql, ',') . ";\n";
    }

    /**
     * @param string $filename
     * @return CarteritasObject
     * @throws Exception
     */
    public function prepareData(string $filename): CarteritasObject
    {
        $ic = new InputClass();
        $data = $ic->readXLSXFile($filename);
        var_dump($data);
        $dataCount = count($data);
        $loadVisitas = $this->loadVisitas($data);
        $object = new CarteritasObject();
        $object->dataCount = $dataCount;
        $object->loadVisitas = $loadVisitas;
        return $object;
    }
}
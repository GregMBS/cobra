<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of InfonavitClass
 *
 * @author gmbs
 */
class InfonavitClass {

    /**
     *
     * @var array
     */
    private $data = array();

    /**
     * 
     * @param array $data
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * 
     * @param float $EXCEL_DATE
     * @return array
     */
    private function excelDateToUnix($EXCEL_DATE) {
        $output = [];
        if ($EXCEL_DATE > 0) {
            $UNIX_DATE = ($EXCEL_DATE - 25569) * 86400;
            $date = gmdate("Y-m-d", $UNIX_DATE);
            $time = gmdate('H:i:s', $UNIX_DATE);
        } else {
            $date = '';
            $time = '00:00:00';
        }
        if (!$date) {
            $date = '';
            $time = '00:00:00';
        }
        $output['date'] = $date;
        $output['time'] = $time;

        return $output;
    }

    public function getGestion() {
        $result = array();
        foreach ($this->data as $row) {
            $fechahora = $this->excelDateToUnix($row['startDate']);
            $d_fech = $fechahora['date'];
            $c_hrin = $fechahora['time'];
            $c_hrfi = $fechahora['time'];
            if (!empty($d_fech)) {
                $temp = array(
                    'CUENTA' => $row['txtNC'],
                    'C_CVGE' => $row['user'],
                    'C_VISIT' => $row['user'],
                    'D_FECH' => $d_fech,
                    'C_HRIN' => $c_hrin,
                    'C_HRFI' => $c_hrfi,
                    'C_CVST' => $row['dictamenbmp'],
                    'C_CSTAT' => $row['EdoAprobacion'],
                    'C_COWN' => $row['etiquetaRI'],
                    'C_NTEL' => $row['telefono'],
                    'C_OBSE1' => $row['comentario_final']
                );
                $clean = str_replace("'", "", $temp);
                $result[] = $clean;
            }
        }
        return $result;
    }

}

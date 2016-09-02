<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of ValidationClass
 *
 * @author gmbs
 */
class ValidationClass {
    
    /**
     *
     * @var \PDO
     */
    private $pdo;
    
    /**
     *
     * @var string
     */
    private $querydup = "SELECT count(1) as ct FROM historia 
WHERE c_cont = :c_cont and d_fech = :d_fech 
and c_hrin = :c_hrin and c_cvst = :c_cvst 
and c_cvge = :c_cvge and c_obse1 = :c_obse1";

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param array $gestion
     * @param string $message
     * @return array
     */
    private function countDup($gestion, $message) {
        $output = array();
        $std = $this->pdo->prepare($this->querydup);
        $std->bindParam(':c_cont', $gestion['C_CONT'], \PDO::PARAM_INT);
        $std->bindParam(':d_fech', $gestion['D_FECH']);
        $std->bindParam(':c_hrin', $gestion['C_HRIN']);
        $std->bindParam(':c_cvst', $gestion['C_CVST']);
        $std->bindParam(':c_cvge', $gestion['C_CVGE']);
        $std->bindParam(':c_obse1', $gestion['C:OBSE1']);
        $std->execute();
        $result = $std->fetch(\PDO::FETCH_ASSOC);
        $output['value'] = $result['ct'];
        if ($result['ct'] == 0) {
            $output['message'] = $message;
        } else {
            $output['message'] = '';
        }
        return $output;
    }    
    
    /**
     * 
     * @param float $monto
     * @param string $status
     * @param string $checkstatus
     * @param string $message
     * @return array
     */
    private function checkPromesaMonto($monto, $status, $checkstatus, $message) {
        $output = array(
            'value' => 0,
            'message' => ''
        );
        if (($monto == 0) && ($checkstatus == $status)) {
            $output['value'] = 1;
            $output['message'] = $message;
        }
        return $output;
    }
    
    /**
     * 
     * @param float $monto
     * @param string $fecha
     * @param string $message
     * @return array
     */
    private function checkMontoFecha($monto, $fecha, $message) {
        $output = array(
            'value' => 0,
            'message' => ''
        );
        if (($monto > 0) && (in_array($fecha, array('0000-00-00', '')))) {
            $output['value'] = 1;
            $output['message'] = $message;
        }
        return $output;        
    }
    
    /**
     * 
     * @param string $field
     * @param string $message
     * @return array
     */
    private function checkRequired($field, $message) {
        $output = array(
            'value' => 0,
            'message' => ''
        );
        if (empty($field)) {
            $output['value'] = 1;
            $output['message'] = $message;
        }
        return $output;        
    }
    
    /**
     * 
     * @param array $gestion
     * @return array
     */
    public function countVisitErrors($gestion) {
        $errorv = 0;
        $flagmsgv = "";

        $dupcount = $this->countDup($gestion, "DOBLE ENTRANTE");
        $errorv += $dupcount['value'];
        $flagmsgv .= $dupcount['message'];

        $promesaMontoT = $this->checkPromesaMonto($gestion['N_PROM'], $gestion['C_CVST'], 'PROMESA DE PAGO TOTAL', "<BR>PROMESA NECESITA MONTO");
        $errorv += $promesaMontoT['value'];
        $flagmsgv .= $promesaMontoT['message'];

        $promesaMontoP = $this->checkPromesaMonto($gestion['N_PROM'], $gestion['C_CVST'], 'PROMESA DE PAGO PARCIAL', "<BR>PROMESA NECESITA MONTO");
        $errorv += $promesaMontoP['value'];
        $flagmsgv .= $promesaMontoP['message'];

        $montoFechaProm = $this->checkMontoFecha($gestion['N_PROM'], $gestion['D_PROM'], "<BR>PROMESA NECESITA FECHA");
        $errorv += $montoFechaProm['value'];
        $flagmsgv .= $montoFechaProm['message'];

        $montoFechaPago = $this->checkMontoFecha($gestion['N_PAGO'], $gestion['D_PAGO'], "<BR>PAGO NECESITA FECHA");
        $errorv += $montoFechaPago['value'];
        $flagmsgv .= $montoFechaPago['message'];

        if (($gestion['N_PROM'] == 0) && ($gestion['D_PROM'] >= $gestion['D_FECH'])) {
            $errorv = $errorv + 1;
            $flagmsgv = $flagmsgv . '<BR>' . "PROMESA NECESITA MONTO";
        }

        $visitRequired = $this->checkRequired($gestion['C_VISIT'], '<BR>VISITADOR ES NECESARIO');
        $errorv += $visitRequired['value'];
        $flagmsgv .= $visitRequired['message'];

        $output = array(
            'errorv' => $errorv,
            'flagmsgv' => $flagmsgv
        );
        return $output;
    }

    /**
     * 
     * @param array $gestion
     * @return array
     */
    public function countGestionErrors($gestion) {
        $error = 0;
        $flagmsg = "";
        $dupcount = $this->countDup($gestion, "DOBLE ENTRANTE");
        $error += $dupcount['value'];
        $flagmsg .= $dupcount['message'];
        $paid = array('PAGANDO CONVENIO', 'PAGO TOTAL', 'PAGO PARCIAL');
        if (($gestion['N_PAGO'] == 0) && (in_array($gestion['C_CVST'], $paid))) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<br>' . 'pago necesita monto';
        }
        if ((substr($gestion['C_CVST'], 0, 11) == 'MENSAJE CON') && ($gestion['C_CARG'] == '')) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "MENSAJE NECESITA PARENTESCO/CARGO";
        }

        $promesaMontoT = $this->checkPromesaMonto($gestion['N_PROM'], 'PROMESA DE PAGO TOTAL', "<BR>PROMESA NECESITA MONTO");
        $error += $promesaMontoT['value'];
        $flagmsg .= $promesaMontoT['message'];

        $promesaMontoP = $this->checkPromesaMonto($gestion['N_PROM'], 'PROMESA DE PAGO PARCIAL', "<BR>PROMESA NECESITA MONTO");
        $error += $promesaMontoP['value'];
        $flagmsg .= $promesaMontoP['message'];

        $montoFechaProm = $this->checkMontoFecha($gestion['N_PROM'], $gestion['D_PROM'], "<BR>PROMESA NECESITA FECHA");
        $error += $montoFechaProm['value'];
        $flagmsg .= $montoFechaProm['message'];

        $montoFechaPago = $this->checkMontoFecha($gestion['N_PAGO'], $gestion['D_PAGO'], "<BR>PAGO NECESITA FECHA");
        $error += $montoFechaPago['value'];
        $flagmsg .= $montoFechaPago['message'];

        if (($gestion['N_PROM'] == 0) && ($gestion['D_PROM'] >= $gestion['D_FECH'])) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
        }
        
        if (($gestion['N_PROM1'] == 0) && ($gestion['N_PROM2'] > 0)) {
            $error = $error + 1;
            $flagmsg = $flagmsg . '<BR>' . "USA PROMESA INICIAL ANTES PROMESA TERMINAL";
        }
        
        $telRequired = $this->checkRequired($gestion['C_TELE'], '<BR>TELEFONO ES NECESARIO');
        $error += $telRequired['value'];
        $flagmsg .= $telRequired['message'];

        $output = array(
            'error' => $error,
            'flagmsg' => $flagmsg
        );
        return $output;
    }
}

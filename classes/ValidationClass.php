<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gregmbs\cobra;

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
     * @var array
     */
    private $paid = array('PAGANDO CONVENIO', 'PAGO TOTAL', 'PAGO PARCIAL');

    /**
     *
     * @var array
     */
    private $proms = array('PROMESA DE PAGO TOTAL', 'PROMESA DE PAGO PARCIAL');

    /**
     *
     * @var array
     */
    private $blankDates = array('', '0000-00-00');

    
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
     * @param boolean $fieldcond
     * @param string $message
     * @return array
     */
    private function checkRequired($fieldcond, $message) {
        $output = array(
            'value' => 0,
            'message' => ''
        );
        if ($fieldcond) {
            $output['value'] = 1;
            $output['message'] = $message;
        }
        return $output;
    }

    /**
     * 
     * @param boolean $fieldcond
     * @param boolean $condition
     * @param string $message
     * @return array
     */
    private function checkRequiredConditional($fieldcond, $condition, $message) {
        $output = array(
            'value' => 0,
            'message' => ''
        );
        if ($condition) {
            if ($fieldcond) {
                $output['value'] = 1;
                $output['message'] = $message;
            }
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

        $requiredArray = array(
            array(empty($gestion['C_CVST']), '<BR>RESUELTO ES NECESARIO'),
            array(empty($gestion['C_VISIT']), '<BR>VISITADOR ES NECESARIO'),
            array(empty($gestion['ACCION']), '<BR>ACCION ES NECESARIO'),
            array(strlen($gestion['C_OBSE1']) >250, "<BR>COMENTARIO DEMASIADO LARGO"),
        );
        $conditionalArray = array(
            array(($gestion['N_PAGO'] == 0), (in_array($gestion['C_CVST'], $this->paid)), '<br>pago necesita monto'),
            array(($gestion['N_PROM'] == 0), (in_array($gestion['C_CVST'], $this->proms)), '<br>promesa necesita monto'),
            array(($gestion['N_PAGO'] > 0), (in_array($gestion['D_PAGO'], $this->blankDates)), '<br>pago necesita fecha'),
            array(($gestion['N_PROM'] > 0), (in_array($gestion['D_PROM'], $this->blankDates)), '<br>promesa necesita fecha'),
            array((substr($gestion['C_CVST'], 0, 11) == 'MENSAJE CON'), ($gestion['C_CARG'] == ''), "<BR>MENSAJE NECESITA PARENTESCO/CARGO"),
            array(($gestion['N_PROM1'] == 0), ($gestion['N_PROM2'] > 0), "<BR>USA PROMESA INICIAL ANTES PROMESA TERMINAL")
        );

        foreach ($requiredArray as $required) {
            $test = $this->checkRequired($required[0], $required[1]);
            $errorv += $test['value'];
            $flagmsgv .= $test['message'];
        }

        foreach ($conditionalArray as $conditional) {
            $test = $this->checkRequiredConditional($conditional[0], $conditional[1], $conditional[2]);
            $errorv += $test['value'];
            $flagmsgv .= $test['message'];
        }

//        $dupcount = $this->countDup($gestion, "<br>DOBLE ENTRANTE");
//        $errorv += $dupcount['value'];
//        $flagmsgv .= $dupcount['message'];

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

        $requiredArray = array(
            array(empty($gestion['C_CVST']), '<BR>RESUELTO ES NECESARIO'),
            array(empty($gestion['C_TELE']), '<BR>TELEFONO ES NECESARIO'),
            array(empty($gestion['ACCION']), '<BR>ACCION ES NECESARIO'),
            array(strlen($gestion['C_OBSE1']) >250, "COMENTARIO DEMASIADO LARGO"),
        );
        $conditionalArray = array(
            array(($gestion['N_PAGO'] == 0), (in_array($gestion['C_CVST'], $this->paid)), '<br>pago necesita monto'),
            array(($gestion['N_PROM'] == 0), (in_array($gestion['C_CVST'], $this->proms)), '<br>promesa necesita monto'),
            array(($gestion['N_PAGO'] > 0), (in_array($gestion['D_PAGO'], $this->blankDates)), '<br>pago necesita fecha'),
            array(($gestion['N_PROM'] > 0), (in_array($gestion['D_PROM'], $this->blankDates)), '<br>promesa necesita fecha'),
            array(($gestion['N_PROM1'] > 0), (in_array($gestion['D_PROM1'], $this->blankDates)), '<br>promesa necesita fecha'),
            array(($gestion['N_PROM2'] > 0), (in_array($gestion['D_PROM2'], $this->blankDates)), '<br>promesa necesita fecha'),
            array(($gestion['N_PROM3'] > 0), (in_array($gestion['D_PROM3'], $this->blankDates)), '<br>promesa necesita fecha'),
            array(($gestion['N_PROM4'] > 0), (in_array($gestion['D_PROM4'], $this->blankDates)), '<br>promesa necesita fecha'),
            array((substr($gestion['C_CVST'], 0, 11) == 'MENSAJE CON'), ($gestion['C_CARG'] == ''), "<BR>MENSAJE NECESITA PARENTESCO/CARGO"),
            array(($gestion['N_PROM1'] == 0), ($gestion['N_PROM2'] > 0), "<BR>USA PROMESA INICIAL ANTES PROMESA TERMINAL")
        );

        foreach ($requiredArray as $required) {
            $test = $this->checkRequired($required[0], $required[1]);
            $error += $test['value'];
            $flagmsg .= $test['message'];
        }

        foreach ($conditionalArray as $conditional) {
            $test = $this->checkRequiredConditional($conditional[0], $conditional[1], $conditional[2]);
            $error += $test['value'];
            $flagmsg .= $test['message'];
        }

//        $dupcount = $this->countDup($gestion, "DOBLE ENTRANTE");
//        $error += $dupcount['value'];
//        $flagmsg .= $dupcount['message'];

         $output = array(
            'errors' => $error,
            'flagmsg' => $flagmsg
        );
        return $output;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;

/**
 * Description of ValidationClass
 *
 * @author gmbs
 */
class ValidationClass {

    /**
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     *
     * @var array
     */
    private array $paid = array('PAGANDO CONVENIO', 'PAGO TOTAL', 'PAGO RECURRENTE', 'PAGO PARCIAL');

    /**
     *
     * @var array
     */
    private array $proms = array('PROMESA DE PAGO TOTAL', 'PROMESA DE PAGO RECURRENTE', 'PROMESA DE PAGO PARCIAL');

    /**
     *
     * @var array
     */
    private array $blankDates = array('', '0000-00-00');

    
    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param boolean $fieldCondition
     * @param string $message
     * @return array
     */
    private function checkRequired(bool $fieldCondition, string $message): array
    {
        $output = array(
            'value' => 0,
            'message' => ''
        );
        if ($fieldCondition) {
            $output['value'] = 1;
            $output['message'] = $message;
        }
        return $output;
    }

    /**
     * 
     * @param boolean $fieldCondition
     * @param boolean $condition
     * @param string $message
     * @return array
     */
    private function checkRequiredConditional($fieldCondition, $condition, $message) {
        $output = array(
            'value' => 0,
            'message' => ''
        );
        if ($condition) {
            if ($fieldCondition) {
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
        $errorV = 0;
        $flagMsgV = "";

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
            $errorV += $test['value'];
            $flagMsgV .= $test['message'];
        }

        foreach ($conditionalArray as $conditional) {
            $test = $this->checkRequiredConditional($conditional[0], $conditional[1], $conditional[2]);
            $errorV += $test['value'];
            $flagMsgV .= $test['message'];
        }

        return array(
            'errorv' => $errorV,
            'flagmsgv' => $flagMsgV
        );
    }

    /**
     * 
     * @param array $gestion
     * @return array
     */
    public function countGestionErrors($gestion) {
        $error = 0;
        $flagMsg = "";

        $requiredArray = array(
            array(empty($gestion['C_CVST']), '<BR>RESUELTO ES NECESARIO'),
            array(empty($gestion['C_TELE']), '<BR>TELÉFONO ES NECESARIO'),
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
            $flagMsg .= $test['message'];
        }

        foreach ($conditionalArray as $conditional) {
            $test = $this->checkRequiredConditional($conditional[0], $conditional[1], $conditional[2]);
            $error += $test['value'];
            $flagMsg .= $test['message'];
        }

        return array(
           'errors' => $error,
           'flagmsg' => $flagMsg
       );
    }

}

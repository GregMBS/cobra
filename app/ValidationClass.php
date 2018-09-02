<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App;

/**
 * Description of ValidationClass
 *
 * @author gmbs
 */
class ValidationClass extends BaseClass
{

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
    private $paid = array(
        'PAGANDO CONVENIO',
        'PAGO TOTAL',
        'PAGO PARCIAL'
    );

    /**
     *
     * @var array
     */
    private $proms = array(
        'PROMESA DE PAGO TOTAL',
        'PROMESA DE PAGO PARCIAL'
    );

    /**
     *
     * @var array
     */
    private $blankDates = array(
        '',
        '0000-00-00'
    );

    /**
     *
     * @param array $gestion
     * @param string $message
     * @return array
     */
    private function countDup($gestion, $message)
    {
        $output = array();
        $std = $this->pdo->prepare($this->querydup);
        $std->bindParam(':c_cont', $gestion['C_CONT'], \PDO::PARAM_INT);
        $std->bindParam(':d_fech', $gestion['D_FECH']);
        $std->bindParam(':c_hrin', $gestion['C_HRIN']);
        $std->bindParam(':c_cvst', $gestion['C_CVST']);
        $std->bindParam(':c_cvge', $gestion['C_CVGE']);
        $std->bindParam(':c_obse1', $gestion['C_OBSE1']);
        $std->execute();
        $result = $std->fetch(\PDO::FETCH_ASSOC);
        $output['value'] = $result['ct'];
        $output['message'] = $message;
        if ($result['ct'] == 0) {
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
    private function checkRequired($fieldcond, $message)
    {
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
    private function checkRequiredConditional($fieldcond, $condition, $message)
    {
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
     * @return ValidationErrorClass
     */
    public function countVisitErrors(array $gestion)
    {
        $output = new ValidationErrorClass();
        $errorv = 0;
        $flagmsgv = '';
        $requiredArray = array(
            array(
                empty($gestion['C_CVST']),
                'RESUELTO ES NECESARIO<br>'
            ),
            array(
                empty($gestion['C_VISIT']),
                'VISITADOR ES NECESARIO<br>'
            ),
            array(
                empty($gestion['ACCION']),
                'ACCION ES NECESARIO<br>'
            ),
            array(
                str_word_count($gestion['C_OBSE1']) < 3,
                "COMENTARIO INCOMPLETO<br>"
            ),
            array(
                strlen($gestion['C_OBSE1']) > 250,
                "COMENTARIO DEMASIADO LARGO<br>"
            )
        );
        $conditionalArray = array(
            array(
                ($gestion['N_PAGO'] == 0),
                (in_array($gestion['C_CVST'], $this->paid)),
                'pago necesita monto<br>'
            ),
            array(
                ($gestion['N_PROM'] == 0),
                (in_array($gestion['C_CVST'], $this->proms)),
                'promesa necesita monto<br>'
            ),
            array(
                ($gestion['N_PAGO'] > 0),
                (in_array($gestion['D_PAGO'], $this->blankDates)),
                'pago necesita fecha<br>'
            ),
            array(
                ($gestion['N_PROM'] > 0),
                (in_array($gestion['D_PROM'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                (substr($gestion['C_CVST'], 0, 11) == 'MENSAJE CON'),
                ($gestion['C_CARG'] == ''),
                "MENSAJE NECESITA PARENTESCO/CARGO<br>"
            ),
            array(
                ($gestion['N_PROM'] == 0),
                ($gestion['D_PROM'] >= $gestion['D_FECH']),
                "PROMESA NECESITA MONTO<br>"
            ),
            array(
                ($gestion['N_PROM1'] == 0),
                ($gestion['N_PROM2'] > 0),
                "USA PROMESA INICIAL ANTES PROMESA TERMINAL<br>"
            )
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
        
        $dupcount = $this->countDup($gestion, "DOBLE ENTRANTE");
        $errorv += $dupcount['value'];
        $flagmsgv .= $dupcount['message'];
        
        $output->flag = ($errorv > 0);
        $output->msg = $flagmsgv;
        return $output;
    }

    /**
     * @param array $gestion
     * @return ValidationErrorClass
     */
    public function countGestionErrors(array $gestion)
    {
        $output = new ValidationErrorClass();
        $error = 0;
        $flagmsg = '';
        $conditionalArray = array(
            array(
                ($gestion['N_PAGO'] == 0),
                (in_array($gestion['C_CVST'], $this->paid)),
                'pago necesita monto<br>'
            ),
            array(
                ($gestion['N_PROM'] == 0),
                (in_array($gestion['C_CVST'], $this->proms)),
                'promesa necesita monto<br>'
            ),
            array(
                ($gestion['N_PAGO'] > 0),
                (in_array($gestion['D_PAGO'], $this->blankDates)),
                'pago necesita fecha<br>'
            ),
            array(
                ($gestion['N_PROM'] > 0),
                (in_array($gestion['D_PROM'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($gestion['N_PROM1'] > 0),
                (in_array($gestion['D_PROM1'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($gestion['N_PROM2'] > 0),
                (in_array($gestion['D_PROM2'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($gestion['N_PROM3'] > 0),
                (in_array($gestion['D_PROM3'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($gestion['N_PROM4'] > 0),
                (in_array($gestion['D_PROM4'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                (substr($gestion['C_CVST'], 0, 11) == 'MENSAJE CON'),
                ($gestion['C_CARG'] == ''),
                "MENSAJE NECESITA PARENTESCO/CARGO<br>"
            ),
            array(
                ($gestion['N_PROM'] == 0),
                ($gestion['D_PROM'] >= $gestion['D_FECH']),
                "PROMESA NECESITA MONTO<br>"
            ),
            array(
                ($gestion['N_PROM1'] == 0),
                ($gestion['N_PROM2'] > 0),
                "USA PROMESA INICIAL ANTES PROMESA TERMINAL<br>"
            )
        );
        
        foreach ($conditionalArray as $conditional) {
            $test = $this->checkRequiredConditional($conditional[0], $conditional[1], $conditional[2]);
            $error += $test['value'];
            $flagmsg .= $test['message'];
        }
        
        $dupcount = $this->countDup($gestion, "DOBLE ENTRANTE");
        $error += $dupcount['value'];
        $flagmsg .= $dupcount['message'];
        
        $output->flag = ($error > 0);
        $output->msg = $flagmsg;
        return $output;
    }
}

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
    private $duplicates = "SELECT count(1) as ct FROM historia 
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
     * @param array $call
     * @param string $message
     * @return array
     */
    private function countDup(array $call, $message)
    {
        $output = array();
        $std = $this->pdo->prepare($this->duplicates);
        $std->bindValue(':c_cont', $call['C_CONT'], \PDO::PARAM_INT);
        $std->bindValue(':d_fech', $call['D_FECH']);
        $std->bindValue(':c_hrin', $call['C_HRIN']);
        $std->bindValue(':c_cvst', $call['C_CVST']);
        $std->bindValue(':c_cvge', $call['C_CVGE']);
        $std->bindValue(':c_obse1', $call['C_OBSE1']);
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
     * @param boolean $fieldCondition
     * @param string $message
     * @return array
     */
    private function checkRequired($fieldCondition, $message)
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
    private function checkRequiredConditional($fieldCondition, $condition, $message)
    {
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
     * @param array $call
     * @return ValidationErrorClass
     */
    public function countVisitErrors(array $call)
    {
        $output = new ValidationErrorClass();
        $error = 0;
        $flagMessage = '';
        $requiredArray = array(
            array(
                empty($call['C_CVST']),
                'RESUELTO ES NECESARIO<br>'
            ),
            array(
                empty($call['C_VISIT']),
                'VISITADOR ES NECESARIO<br>'
            ),
            array(
                empty($call['C_ACCION']),
                'ACCION ES NECESARIO<br>'
            ),
            array(
                str_word_count($call['C_OBSE1']) < 3,
                "COMENTARIO INCOMPLETO<br>"
            ),
            array(
                strlen($call['C_OBSE1']) > 250,
                "COMENTARIO DEMASIADO LARGO<br>"
            )
        );
        $conditionalArray = array(
            array(
                ($call['N_PAGO'] == 0),
                (in_array($call['C_CVST'], $this->paid)),
                'pago necesita monto<br>'
            ),
            array(
                ($call['N_PROM'] == 0),
                (in_array($call['C_CVST'], $this->proms)),
                'promesa necesita monto<br>'
            ),
            array(
                ($call['N_PAGO'] > 0),
                (in_array($call['D_PAGO'], $this->blankDates)),
                'pago necesita fecha<br>'
            ),
            array(
                ($call['N_PROM'] > 0),
                (in_array($call['D_PROM'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                (substr($call['C_CVST'], 0, 11) == 'MENSAJE CON'),
                ($call['C_CARG'] == ''),
                "MENSAJE NECESITA PARENTESCO/CARGO<br>"
            ),
            array(
                ($call['N_PROM'] == 0),
                ($call['D_PROM'] >= $call['D_FECH']),
                "PROMESA NECESITA MONTO<br>"
            ),
            array(
                ($call['N_PROM1'] == 0),
                ($call['N_PROM2'] > 0),
                "USA PROMESA INICIAL ANTES PROMESA TERMINAL<br>"
            )
        );
        
        foreach ($requiredArray as $required) {
            $test = $this->checkRequired($required[0], $required[1]);
            $error += $test['value'];
            $flagMessage .= $test['message'];
        }
        
        foreach ($conditionalArray as $conditional) {
            $test = $this->checkRequiredConditional($conditional[0], $conditional[1], $conditional[2]);
            $error += $test['value'];
            $flagMessage .= $test['message'];
        }
        
        $duplicateCount = $this->countDup($call, "DOBLE ENTRANTE");
        $error += $duplicateCount['value'];
        $flagMessage .= $duplicateCount['message'];
        
        $output->flag = ($error > 0);
        $output->msg = $flagMessage;
        return $output;
    }

    /**
     * @param array $call
     * @return ValidationErrorClass
     */
    public function countCallErrors(array $call)
    {
        $output = new ValidationErrorClass();
        $error = 0;
        $flagMessage = '';
        if (empty($call['C_CVST'])) {
            $error = 1;
            $flagMessage .= 'se necesita estatus<br>';
        }
        if (empty($call['C_CVGE'])) {
            $error = 1;
            $flagMessage .= 'se necesita gestor<br>';
        }
        if (empty($call['C_TELE'])) {
            $error = 1;
            $flagMessage .= 'se necesita telefono<br>';
        }
        if (empty($call['C_ACCION'])) {
            $error = 1;
            $flagMessage .= 'se necesita accion<br>';
        }
        if (empty($call['C_OBSE1'])) {
            $error = 1;
            $flagMessage .= 'se necesita gestion<br>';
        } elseif (str_word_count($call['C_OBSE1']) < 3) {
            $error = 1;
            $flagMessage .= 'gestion incumplida<br>';
        }
        $D_PROM = max($call['D_PROM1'], $call['D_PROM2'], $call['D_PROM3'], $call['D_PROM4']);
        $D_FECH = date('Y-m-d');
        $conditionalArray = array(
            array(
                ($call['N_PAGO'] == 0),
                (in_array($call['C_CVST'], $this->paid)),
                'pago necesita monto<br>'
            ),
            array(
                ($call['N_PROM'] == 0),
                (in_array($call['C_CVST'], $this->proms)),
                'promesa necesita monto<br>'
            ),
            array(
                ($call['N_PAGO'] > 0),
                (in_array($call['D_PAGO'], $this->blankDates)),
                'pago necesita fecha<br>'
            ),
            array(
                ($call['N_PROM'] > 0),
                (in_array($D_PROM, $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($call['N_PROM1'] > 0),
                (in_array($call['D_PROM1'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($call['N_PROM2'] > 0),
                (in_array($call['D_PROM2'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($call['N_PROM3'] > 0),
                (in_array($call['D_PROM3'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                ($call['N_PROM4'] > 0),
                (in_array($call['D_PROM4'], $this->blankDates)),
                'promesa necesita fecha<br>'
            ),
            array(
                (substr($call['C_CVST'], 0, 11) == 'MENSAJE CON'),
                ($call['C_CARG'] == ''),
                "MENSAJE NECESITA PARENTESCO/CARGO<br>"
            ),
            array(
                ($call['N_PROM'] == 0),
                ($D_PROM >= $D_FECH),
                "PROMESA NECESITA MONTO<br>"
            ),
            array(
                ($call['N_PROM1'] == 0),
                ($call['N_PROM2'] > 0),
                "USA PROMESA INICIAL ANTES PROMESA TERMINAL<br>"
            )
        );
        
        foreach ($conditionalArray as $conditional) {
            $test = $this->checkRequiredConditional($conditional[0], $conditional[1], $conditional[2]);
            $error += $test['value'];
            $flagMessage .= $test['message'];
        }
        
        $duplicateCount = $this->countDup($call, "DOBLE ENTRANTE");
        $error += $duplicateCount['value'];
        $flagMessage .= $duplicateCount['message'];
        
        $output->flag = ($error > 0);
        $output->msg = $flagMessage;
        return $output;
    }
}

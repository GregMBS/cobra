<?php

namespace cobra_salsa;

use PDO;
use PDOException;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

/**
 * Description of BuscarClass
 *
 * @author gmbs
 */
class BuscarClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    /**
     *
     * @var string
     */
    private $queryHead = "SELECT SQL_NO_CACHE * from resumen ";

    /**
     *
     * @var string
     */
    private $refString = "WHERE
(nombre_deudor_alterno regexp :find or
nombre_referencia_1 regexp :find or
nombre_referencia_2 regexp :find or
nombre_referencia_3 regexp :find or
nombre_referencia_4 regexp :find)";

    /**
     *
     * @var string
     */
    private $telString = "WHERE
(tel_1 regexp :find or
tel_2 regexp :find or
tel_3 regexp :find or
tel_4 regexp :find or
tel_1_alterno regexp :find or
tel_2_alterno regexp :find or
tel_3_alterno regexp :find or
tel_4_alterno regexp :find or
tel_1_ref_1 regexp :find or
tel_2_ref_1 regexp :find or
tel_1_ref_2 regexp :find or
tel_2_ref_2 regexp :find or
tel_1_ref_3 regexp :find or
tel_2_ref_3 regexp :find or
tel_1_ref_4 regexp :find or
tel_2_ref_4 regexp :find or
tel_1_laboral regexp :find or
tel_2_laboral regexp :find or
tel_1_verif regexp :find or
tel_2_verif regexp :find or
tel_3_verif regexp :find or
tel_4_verif regexp :find )";

    /**
     *
     * @var string
     */
    private $robotString = "SELECT SQL_NO_CACHE
			distinct resumen.*
			FROM resumen, historia
			WHERE c_tele REGEXP :find and c_cont=id_cuenta";

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $field
     * @return string
     */
    private function searchField($field) {
        switch ($field) {
            case 'id_cuenta':
                $output = "where id_cuenta = :find order by id_cuenta ";
                break;
            case 'nombre_deudor':
                $output = "where nombre_deudor regexp :find ";
                break;
            case 'numero_de_cuenta':
                $output = "where numero_de_cuenta regexp :find ";
                break;
            case 'numero_de_credito':
                $output = "where numero_de_credito regexp :find ";
                break;
            case 'domicilio_deudor':
                $output = "where domicilio_deudor regexp :find ";
                break;
            case 'REFS':
                $output = $this->refString;
                break;
            case 'TELS':
                $output = $this->telString;
                break;
            default:
                $output = '';
                break;
        }
        return $output;
    }

    /**
     * 
     * @param string $field
     * @param string $find
     * @param string $CLIENTE
     * @return array
     */
    public function searchAccounts($field, $find, $CLIENTE) {
        if ($field == 'ROBOT') {
            $querymain = $this->robotString;
        } else {
            $querymain = $this->queryHead . $this->searchField($field);
        }
        $cliFlag = 0;
        if ((isset($querymain)) && (strlen($CLIENTE) > 1)) {
            $querymain = $querymain . " and cliente = :cliente ";
            $cliFlag = 1;
        }
        try {
            $stm = $this->pdo->prepare($querymain);
            $stm->bindParam(':find', $find);
            if ($cliFlag == 1) {
                $stm->bindParam(':cliente', $CLIENTE);
            }
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS, ResumenObject::class);
        } catch (PDOException $e) {
            $result = array();
        }

        return $result;
    }

    /**
     * 
     * @return string[]
     */
    public function listClients() {
        $query = "SELECT cliente FROM clientes";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_COLUMN, 0);
    }

}

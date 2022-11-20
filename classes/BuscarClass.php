<?php

namespace cobra_salsa;

use PDO;
use PDOException;

require_once 'classes/../classes/PdoClass.php';
require_once 'classes/../classes/ResumenObject.php';

/**
 * Description of BuscarClass
 *
 * @author gmbs
 */
class BuscarClass {

    /**
     * @var PDO $pdo
     */
    protected PDO $pdo;

    /**
     *
     * @var string
     */
    private string $queryHead = "SELECT SQL_NO_CACHE * from resumen ";

    /**
     *
     * @var string
     */
    private string $refString = "WHERE
(nombre_deudor_alterno regexp :find or
nombre_referencia_1 regexp :find or
nombre_referencia_2 regexp :find or
nombre_referencia_3 regexp :find or
nombre_referencia_4 regexp :find)";

    /**
     *
     * @var string
     */
    private string $telString = "WHERE
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
    private string $refExactString = "WHERE
(nombre_deudor_alterno = :find or
nombre_referencia_1 = :find or
nombre_referencia_2 = :find or
nombre_referencia_3 = :find or
nombre_referencia_4 = :find)";

    /**
     *
     * @var string
     */
    private string $telExactString = "WHERE
(tel_1 = :find or
tel_2 = :find or
tel_3 = :find or
tel_4 = :find or
tel_1_alterno = :find or
tel_2_alterno = :find or
tel_3_alterno = :find or
tel_4_alterno = :find or
tel_1_ref_1 = :find or
tel_2_ref_1 = :find or
tel_1_ref_2 = :find or
tel_2_ref_2 = :find or
tel_1_ref_3 = :find or
tel_2_ref_3 = :find or
tel_1_ref_4 = :find or
tel_2_ref_4 = :find or
tel_1_laboral = :find or
tel_2_laboral = :find or
tel_1_verif = :find or
tel_2_verif = :find or
tel_3_verif = :find or
tel_4_verif = :find )";

    /**
     *
     * @var string
     */
    private string $robotString = "SELECT SQL_NO_CACHE
			distinct resumen.*
			FROM resumen, historia
			WHERE c_tele REGEXP :find and c_cont=id_cuenta";

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param string $CLIENTE
     * @param string $queryMain
     * @param string $find
     * @return array
     */
    public function runSearch(string $CLIENTE, string $queryMain, string $find): array
    {
        $cliFlag = 0;
        if (strlen($CLIENTE) > 1) {
            $queryMain .= " and cliente = :cliente ";
            $cliFlag = 1;
        }
        $queryMain .= " LIMIT 1000 ";
        try {
            $stm = $this->pdo->prepare($queryMain);
            $stm->bindParam(':find', $find);
            if ($cliFlag === 1) {
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
     * @param string $field
     * @return string
     */
    private function searchField(string $field): string
    {
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
     * @return string
     */
    private function searchExactField(string $field): string
    {
        switch ($field) {
            case 'id_cuenta':
                $output = "where id_cuenta = :find order by id_cuenta ";
                break;
            case 'nombre_deudor':
                $output = "where nombre_deudor = :find ";
                break;
            case 'numero_de_cuenta':
                $output = "where numero_de_cuenta = :find ";
                break;
            case 'numero_de_credito':
                $output = "where numero_de_credito = :find ";
                break;
            case 'domicilio_deudor':
                $output = "where domicilio_deudor = :find ";
                break;
            case 'REFS':
                $output = $this->refExactString;
                break;
            case 'TELS':
                $output = $this->telExactString;
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
    public function searchAccounts(string $field, string $find, string $CLIENTE): array
    {
        $queryMain = $this->queryHead . $this->searchExactField($field);
        if ($field === 'ROBOT') {
            $queryMain = $this->robotString;
        }
        $result = $this->runSearch($CLIENTE, $queryMain, $find);
        if (($field !== 'ROBOT') && (count($result) === 0))
        {
            $queryMain = $this->queryHead . $this->searchField($field);
            $result = $this->runSearch($CLIENTE, $queryMain, $find);
        }
        return $result;
    }

    /**
     * 
     * @return string[]
     */
    public function listClients(): array
    {
        $query = "SELECT cliente FROM clientes";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_COLUMN, 0);
    }

}

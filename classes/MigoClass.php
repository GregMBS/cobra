<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ResumenObject.php';

/**
 * Description of MigoClass
 *
 * @author gmbs
 */
class MigoClass
{

    /**
     * @var string[]
     */
    public $keys = [
        'numero_de_cuenta',
        'nombre_deudor',
        'cliente',
        'status_de_credito',
        'saldo_total',
        'saldo_descuento_2',
        'status_aarsa',
        'fecha_ultima_gestion'
    ];

    /**
     * @var PDO $pdo
     */
    protected PDO $pdo;

    /**
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAjax(array $keys, $capt = '')
    {
        ## Read value
        $draw = filter_input(INPUT_GET, 'draw', FILTER_VALIDATE_INT);
        $row = filter_input(INPUT_GET, 'start', FILTER_VALIDATE_INT);
        $rowPerPage = filter_input(INPUT_GET, 'length', FILTER_VALIDATE_INT);
        $order = filter_input(INPUT_GET, 'order', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $columns = filter_input(INPUT_GET, 'columns', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $search = filter_input(INPUT_GET, 'search', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $columnIndex = $order[0]['column']; // Column index
        $columnName = $columns[$columnIndex]['data']; // Column name
        $columnSortOrder = $order[0]['dir']; // asc or desc
        $searchValue = $search['value']; // Search value

        $totalRecords = $this->countTotalRecords();
        list($searchArray, $searchQuery) = $this->buildQuery($keys, $searchValue, $capt);
        $totalRecordsFiltered = $this->countFilteredRecords($searchQuery, $searchArray);
        $empRecords = $this->getFiltered($searchArray, $searchQuery, $columnName, $columnSortOrder, $row, $rowPerPage);

        $data = array();

        foreach ($empRecords as $row) {
            $array = [];
            foreach ($keys as $key) {
                $array[$key] = $row->$key;
            }
            $data[] = $array;
        }

## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsFiltered,
            "aaData" => $data
        );

        return json_encode($response);
    }

    /**
     * @return int
     */
    private function countTotalRecords(): int
    {
## Total number of records without filtering
        $stmt = $this->pdo->prepare("SELECT COUNT(1) AS all_count FROM resumen 
        WHERE status_de_credito NOT REGEXP '-'");
        $stmt->execute();
        $records = $stmt->fetch();
        return $records['all_count'];
    }

    /**
     * @param string[] $keys
     * @param $searchValue
     * @param $capt
     * @return array
     */
    private function buildQuery(array $keys, $searchValue, $capt = ''): array
    {
## Search
        $searchArray = [];
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchBase = " %s LIKE :%s OR";
            $searchString = "";
            foreach ($keys as $key) {
                $searchString .= sprintf($searchBase, $key, $key);
                $searchArray[$key] = "%$searchValue%";
            }
            $trimString = substr($searchString, 0, -2);
            $searchQuery = " AND ( $trimString ) ";

        }
        if ($capt) {
            $searchQuery .= " AND ejecutivo_asignado_call_center = :capt ";
            $searchArray['capt'] = $capt;
        }
        return array($searchArray, $searchQuery);
    }

    /**
     * @param string $searchQuery
     * @param $searchArray
     * @return int
     */
    private function countFilteredRecords(string $searchQuery, $searchArray): int
    {
## Total number of records with filtering
        $stmt = $this->pdo->prepare("SELECT COUNT(1) AS all_count FROM resumen 
        WHERE status_de_credito NOT REGEXP '-' " . $searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        return $records['all_count'];
    }

    /**
     * @param array $searchArray
     * @param string $searchQuery
     * @param string $columnName
     * @param string $columnSortOrder
     * @param int $row
     * @param int $rowPerPage
     * @return ResumenObject[]
     */
    private function getFiltered($searchArray, $searchQuery, $columnName = '', $columnSortOrder = 'ASC', $row = 0, $rowPerPage = 10): array
    {

        if (is_null($row)) {
            $row = 0;
        }
        if (is_null($rowPerPage)) {
            $rowPerPage = 10;
        }
        if ($rowPerPage < 10) {
            $rowPerPage = 10;
        }
        if (is_null($columnName)) {
            $columnName = 'id_cuenta';
        }
        ## Fetch records
        $query = "SELECT * FROM resumen WHERE status_de_credito NOT REGEXP '-' "
            . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset";


        $stmt = $this->pdo->prepare($query);

// Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, ResumenObject::class);
    }

}

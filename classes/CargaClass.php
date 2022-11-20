<?php

namespace cobra_salsa;

use Exception;
use PDO;
use PDOException;
use RuntimeException;

require_once __DIR__ . '/CargadexObject.php';
require_once __DIR__ . '/ColumnObject.php';
require_once __DIR__ . '/HeaderObject.php';
require_once __DIR__ . '/CargaPickObject.php';

/**
 * Description of CargaClass
 *
 * @author gmbs
 */
class CargaClass
{

    /**
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     *
     * @var string[]
     */
    private array $internal = array(
        'id_cuenta',
        'especial',
        'fecha_de_actualizacion',
        'locker',
        'timelock'
    );

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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
     *
     * @return array
     */
    public function getDBColumnNames(): array
    {
        $columnArray = array();
        $query = "SHOW COLUMNS FROM resumen";
        $stc = $this->pdo->query($query);
        $result = $stc->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $columnArray[] = $row['Field'];
        }
        return $columnArray;
    }

    /**
     * @param array $post
     * @throws Exception
     */
    public function asociar(array $post): void
    {
        $fields = $this->loadCargadex($post);
        $dupCheck = $this->array_dup($fields);
        if (!empty($dupCheck)) {
            echo "Duplicate fields: ";
            die($dupCheck);
        }

        $columnNames = $this->getDataColumnNames($fields);

        $this->prepareTemp($columnNames);
        $filename = filter_var($post['filename'], FILTER_SANITIZE_STRING);
        $data = $this->getDataCSV($filename);
        $count = $this->loadData($data, $columnNames);
        echo $count. " total records loaded. ";

        $fieldList = $this->getNewFields();
        $updateList = $this->prepareUpdate($fieldList);
        $countUpdate = $this->updateResumen($updateList);
        echo $countUpdate . " old records updated. ";

        $countInsert = $this->insertIntoResumen($fieldList);
        echo $countInsert . " new records inserted.";
        $this->updateClientes();
        $this->updatePagos();
        $this->createLookupTable();

        $countNew = $this->setFechaAsigna();
        echo $countNew . " completely new accounts added.";
    }

    /**
     * @return int
     * @throws Exception
     */
    private function setFechaAsigna(): int
    {
        $query = "update resumen
set fecha_de_asignacion=fecha_de_actualizacion
where fecha_de_asignacion is null";
        try {
            $sti = $this->pdo->query($query);
            return $sti->rowCount();

        } catch (PDOException $Exception) {
            throw new PDOException($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * @param $ar
     * @return array
     */
    private function array_dup($ar): array
    {
        return array_unique(array_diff_assoc($ar,array_unique($ar)));
    }

    /**
     *
     * @return ColumnObject[]
     */
    public function getDBColumns(): array
    {
        $query = "SHOW COLUMNS FROM resumen";
        $stc = $this->pdo->query($query);
        return $stc->fetchAll(PDO::FETCH_CLASS, ColumnObject::class);
    }

    /**
     * @param int $pos
     * @param array $columns
     * @param string $cliente
     * @return string
     */
    private function insertIntoCargadex(int $pos, array $columns, string $cliente): string
    {
        $column = $columns[$pos];
        $nField = $column->Field;
        $nType = $column->Type;
        $nNullOk = $column->Null;
        $nPosition = $pos;
        if (stripos($pos, 'nousar') === 0) {
            $nField = 'nousar';
            $nType = '';
            $nNullOk = '';
            $nPosition = '';
        }
        $query = "insert into cargadex (field,type,nullOk,position,cliente) values ('$nField','$nType','$nNullOk','$nPosition','$cliente');";
        $this->pdo->query($query);
        return $nField;
    }

    /**
     *
     * @param array $row
     * @return array
     */
    public function getDataColumnNames(array $row): array
    {
        $columnArray = array();
        /** @var string $columnName */
        foreach ($row as $columnName) {
            $cn = $columnName;
            if ($columnName === '') {
                $cn = 'empty';
            }
            if (in_array($cn, $this->internal, true)) {
                $cn = $columnName . '_solo_internal';
            }
            $columnArray[] = $cn;
        }
        return $columnArray;
    }

    /**
     *
     * @param array $columnNames
     * @throws Exception
     */
    public function prepareTemp(array $columnNames): void
    {
        $queryDrop = "DROP TABLE IF EXISTS temp;";
        try {
            $this->pdo->query($queryDrop);
        } catch (PDOException $Exception) {
            throw new PDOException($Exception);
        }
        $queryStart = "CREATE TABLE temp 
        ENGINE=INNODB AUTO_INCREMENT=10 
        DEFAULT CHARSET=utf8 
        COLLATE=utf8_spanish_ci 
        SELECT " .
            implode(',', $columnNames) .
            ", CURDATE() as fecha_de_actualizacion 
            FROM resumen LIMIT 0";
        try {
            $this->pdo->query($queryStart);
        } catch (PDOException $Exception) {
            throw new PDOException($Exception);
        }
        $queryIndex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50))";
        try {
            $this->pdo->query($queryIndex);
        } catch (PDOException $Exception) {
            throw new PDOException($Exception);
        }
    }

    /**
     *
     * @param array $data
     * @param array $columnNames
     * @return int
     * @throws Exception
     */
    public function loadData(array $data, array $columnNames): int
    {
        $glue = ',';
        $list = implode($glue, $columnNames);
        $count = 0;
        foreach ($data as $row) {
            $queryLoad = "INSERT IGNORE INTO temp (" . $list . ", fecha_de_actualizacion) VALUES ";
            $limpio = str_replace("'", "", $row);
            $queryLoadTrim = $queryLoad . "('" . implode("','", $limpio) . "', CURDATE());";
            try {
                $this->pdo->query($queryLoadTrim);
                $queryCleanBlank = "DELETE FROM temp WHERE numero_de_cuenta = ''";
                $this->pdo->query($queryCleanBlank);
                $queryCountTemp = "SELECT COUNT(1) AS 'ct' FROM temp";
                $stc = $this->pdo->query($queryCountTemp);
                $result = $stc->fetch(PDO::FETCH_ASSOC);
                $count = $result['ct'];
            } catch (PDOException $Exception) {
                throw new PDOException($Exception);
            }
        }
        return $count;
    }

    /**
     * @return array
     */
    private function getNewFields(): array
    {
        $query = "show fields from temp where field not regexp 'nousar'";
        $result = $this->pdo->query($query);
        return $result->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    /**
     *
     * @param array $columnNames
     * @return array
     */
    public function prepareUpdate(array $columnNames): array
    {
        $output = array();
        foreach ($columnNames as $name) {
            $output[] = 'resumen.' . $name . '=temp.' . $name;
        }
        return $output;
    }

    /**
     *
     * @param array $fieldList
     * @return int
     * @throws Exception
     */
    public function updateResumen(array $fieldList): int
    {
        $fields = implode(',', $fieldList);
        $query = "UPDATE IGNORE temp, resumen
            SET " . $fields . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta
            and temp.cliente=resumen.cliente";
        try {
            $stu = $this->pdo->query($query);
            return $stu->rowCount();
        } catch (PDOException $Exception) {
            throw new PDOException($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     *
     * @param array $fieldList
     * @return int
     * @throws Exception
     */
    public function insertIntoResumen(array $fieldList): int
    {
        $fields = implode(',', $fieldList);
        $query = /** @lang Text */ "insert ignore into resumen (" . $fields . ") select " . $fields . " from temp";
        try {
            $sti = $this->pdo->query($query);
            return $sti->rowCount();

        } catch (PDOException $Exception) {
            throw new PDOException($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     *
     */
    public function updateClientes(): void
    {

        $query = "INSERT IGNORE INTO clientes 
        SELECT cliente FROM resumen";
        $this->pdo->query($query);
    }

    /**
     *
     */
    private function updatePagos(): void
    {
        $query = "insert ignore into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
select numero_de_cuenta, fecha_de_ultimo_pago, 
monto_ultimo_pago, cliente, c_cvge, 1, id_cuenta 
from resumen 
left join historia h1 on c_cont=id_cuenta and n_prom>0
where fecha_de_ultimo_pago>last_day(curdate() - INTERVAL 31 day) 
AND monto_ultimo_pago>0 
and not exists (select * from historia h2 
where h2.d_fech>h1.d_fech and h2.c_cont=h1.c_cont and h2.n_prom>0) 
and fecha_de_ultimo_pago < fecha_de_actualizacion 
group by id_cuenta,c_cvge,fecha_de_ultimo_pago having fecha_de_ultimo_pago>min(d_fech)
";
        $this->pdo->query($query);
    }

    /**
     *
     */
    private function createLookupTable(): void
    {
        $queryTruncate = "truncate rlook";
        $this->pdo->query($queryTruncate);
        $queryInsert = "insert into rlook
select id_cuenta,numero_de_cuenta,nombre_deudor,cliente,status_de_credito,
nombre_referencia_1,nombre_referencia_2,nombre_referencia_3,nombre_referencia_4,
tel_1,tel_2,tel_3,tel_4,
tel_1_alterno,tel_2_alterno,tel_3_alterno,tel_4_alterno,
tel_1_verif,tel_2_verif,tel_3_verif,tel_4_verif,
tel_1_ref_1,tel_2_ref_1,
tel_1_ref_2,tel_2_ref_2,
tel_1_ref_3,tel_2_ref_3,
tel_1_ref_4,tel_2_ref_4,
tel_1_laboral,tel_2_laboral,telefonos_marcados
from resumen;
";
        $this->pdo->query($queryInsert);
    }

    /**
     * @param $post
     * @return CargaPickObject
     * @throws Exception
     */
    public function clientePick($post): CargaPickObject
    {
        $cliente = filter_var($post['cliente'], FILTER_SANITIZE_STRING);
        $fecha_de_actualizacion = date('Y-m-d');
        if (isset($post['fecha_de_actualizacion'])) {
            $fecha_de_actualizacion = filter_var($post['fecha_de_actualizacion'], FILTER_SANITIZE_STRING);
        }
        $this->clearCargadex($cliente);
        $filename = filter_var($post['filename'], FILTER_SANITIZE_STRING);
        $headerData = $this->getHeaderDataCSV($filename);
        $pick = new CargaPickObject();
        $pick->setCliente($cliente);
        $pick->setPost($post);
        $pick->setFechaDeActualizacion($fecha_de_actualizacion);
        $pick->setFilename($filename);
        $pick->setHeader($headerData->getHeader());
        $pick->setData($headerData->getData());
        $pick->setNum($headerData->getNum());
        return $pick;
    }

    /**
     * @param $cliente
     */
    private function clearCargadex($cliente): void
    {
        $query = "delete from cargadex where cliente = :cliente";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':cliente', $cliente);
        $stq->execute();
    }

    /**
     * @param string $cliente
     * @return int
     */
    public function countCargadex(string $cliente): int
    {
        $query = "select count(1) as cnt from cargadex where cliente = :cliente";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':cliente', $cliente);
        $stc->execute();
        $result = $stc->fetch(PDO::FETCH_ASSOC);
        return (int)$result['cnt'];
    }

    /**
     * @param string $filename
     * @return HeaderObject
     * @throws Exception
     */
    private function getHeaderDataCSV(string $filename): HeaderObject
    {
        $data = [];
        try {
            $handle = fopen($filename, 'rb');
            $header = fgetcsv($handle);
            while ($row = fgetcsv($handle)) {
                $data[] = $row;
            }
            fclose($handle);
        } catch (Exception $e) {
            throw new PDOException($e);
        }
        $num = 0;
        while ($num === 0) {
            $num = count($header);
        }
        $headerData = new HeaderObject();
        $headerData->setData($data);
        $headerData->setHeader($header);
        $headerData->setNum($num);
        return $headerData;
    }

    /**
     * @param $filename
     * @return array
     * @throws Exception
     */
    private function getDataCSV($filename): array
    {
        $data = [];
        try {
            $handle = fopen($filename, 'rb');
            fgetcsv($handle);
            while ($row = fgetcsv($handle)) {
                $data[] = $row;
            }
            fclose($handle);
        } catch (Exception $e) {
            throw new RuntimeException($e);
        }
        return $data;
    }

    /**
     * @param array $post
     * @return array
     */
    private function loadCargadex(array $post): array
    {
        $cliente = filter_var($post['cliente'], FILTER_SANITIZE_STRING);
        $columns = $this->getDBColumns();
        $fields = [];

        if (!empty($post['pos'])) {
            /** @var int $posit */
            foreach ($post['pos'] as $posit) {
                $fields[] = $this->insertIntoCargadex($posit, $columns, $cliente);
            }
        }
        return $fields;
    }
}

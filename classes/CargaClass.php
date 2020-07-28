<?php

namespace cobra_salsa;

use Exception;
use PDO;
use PDOException;

require_once __DIR__ . '/CargadexObject.php';
require_once __DIR__ . '/ColumnObject.php';

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
    private $pdo;

    /**
     *
     * @var array
     */
    private $internal = array(
        'id_cuenta',
        'especial',
        'fecha_de_actualizacion',
        'locker',
        'timelock'
    );

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @return string
     */
    public function moveLoadedFile()
    {
        $destination = "/tmp/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
        return $destination;
    }

    /**
     *
     * @return array
     */
    public function getDBColumnNames()
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
     *
     * @param array $dataNames
     * @param array $dbNames
     * @return array
     */
    public function nameCheck($dataNames, $dbNames)
    {
        $oops = array();
        foreach ($dataNames as $name) {
            $match = in_array($name, $dbNames);
            if (!$match) {
                $oops[] = $name;
            }
        }
        return $oops;
    }

    /**
     * @param array $post
     * @throws Exception
     */
    public function asociar(array $post): void
    {
        $cliente = filter_var($post['cliente'], FILTER_SANITIZE_STRING);
        $columns = $this->getDBColumns();
        $fields = [];

        if (!empty($post['pos'])) {
            foreach ($post['pos'] as $pos) {
                $fields[] = $this->insertIntoCargadex($pos, $columns, $cliente);
            }
        }

        $columnNames = $this->getDataColumnNames($fields);
        $this->prepareTemp($columnNames);

        $filename = filter_var($post['filename'], FILTER_SANITIZE_STRING);
        list($data, $header, $num) = $this->getHeaderDataCSV($filename);
        $count = $this->loadData($data, $columnNames);
        echo $count. " total records loaded. ";

        $fieldlist = $this->getNewFields();
        $updateList = $this->prepareUpdate($fieldlist);
        $countUpdate = $this->updateResumen($updateList);
        echo $countUpdate . " old records updated. ";

        $countInsert = $this->insertIntoResumen($fieldlist);
        echo $countInsert . " new records inserted.";
        $this->updateClientes();
        $this->updatePagos();
        $this->createLookupTable();
    }

    /**
     *
     * @return ColumnObject[]
     */
    public function getDBColumns()
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
        if (stripos($pos, 'nousar') === 0) {
            $nField = 'nousar';
            $nType = '';
            $nNullOk = '';
            $nPosition = '';
        } else {
            $nField = $column->Field;
            $nType = $column->Type;
            $nNullOk = $column->Null;
            $nPosition = $pos;
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
    public function getDataColumnNames($row)
    {
        $columnArray = array();
        foreach ($row as $columnName) {
            $cn = $columnName;
            if ($columnName == '') {
                $cn = 'vacio';
            }
            if (in_array($cn, $this->internal)) {
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
    public function prepareTemp($columnNames)
    {
        $queryDrop = "DROP TABLE IF EXISTS temp;";
        try {
            $std = $this->pdo->prepare($queryDrop);
            $std->execute();
        } catch (PDOException $Exception) {
            throw new Exception($Exception);
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
            $stc = $this->pdo->prepare($queryStart);
            $stc->execute();
        } catch (PDOException $Exception) {
            throw new Exception($Exception);
        }
        $queryIndex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50))";
        try {
            $sta = $this->pdo->prepare($queryIndex);
            $sta->execute();
        } catch (PDOException $Exception) {
            throw new Exception($Exception);
        }
    }

    /**
     *
     * @param array $data
     * @param array $columnNames
     * @return int
     * @throws Exception
     */
    public function loadData(array $data, $columnNames)
    {
        $glue = ',';
        $list = implode($glue, $columnNames);
        $queryLoad = "INSERT INTO temp (" . $list . ", fecha_de_actualizacion) VALUES ";
        foreach ($data as $row) {
                $limpio = str_replace("'", "", $row);
                $queryLoad .= "('" . implode("','", $limpio) . "', CURDATE()),";
        }
        $queryLoadTrim = rtrim($queryLoad, ",");
        die($queryLoadTrim);
        try {
            $stl = $this->pdo->prepare($queryLoadTrim);
            $stl->execute();
            return $stl->rowCount();
        } catch (PDOException $Exception) {
            throw new Exception($Exception);
        }
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
    public function prepareUpdate($columnNames)
    {
        $output = array();
        foreach ($columnNames as $name) {
            $output[] = 'resumen.' . $name . '=temp.' . $name;
        }
        return $output;
    }

    /**
     *
     * @param array $fieldlist
     * @return int
     * @throws Exception
     */
    public function updateResumen($fieldlist)
    {
        $fields = implode(',', $fieldlist);
        $query = "UPDATE temp, resumen
            SET " . $fields . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta
            and temp.cliente=resumen.cliente";
        try {
            $stu = $this->pdo->prepare($query);
            $stu->execute();
            return $stu->rowCount();
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     *
     * @param array $fieldlist
     * @return int
     * @throws Exception
     */
    public function insertIntoResumen($fieldlist)
    {
        $fields = implode(',', $fieldlist);
        $query = "insert ignore into resumen (" . $fields . ") select " . $fields . " from temp";
        try {
            $sti = $this->pdo->prepare($query);
            $sti->execute();
            return $sti->rowCount();
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     *
     */
    public function updateClientes()
    {

        $query = "INSERT IGNORE INTO clientes 
        SELECT cliente FROM resumen";
        $this->pdo->query($query);
    }

    /**
     *
     */
    private function updatePagos()
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
group by id_cuenta,c_cvge having fecha_de_ultimo_pago>min(d_fech)
";
        $this->pdo->query($query);
    }

    /**
     *
     */
    private function createLookupTable()
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
     * @param string $cliente
     * @return CargadexObject[]
     */
    public function getCargadex(string $cliente): array
    {
        $query = "SELECT * from cargadex WHERE cliente = :cliente";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':cliente', $cliente);
        $stc->execute();
        $cargadex = $stc->fetchAll(PDO::FETCH_CLASS, CargadexObject::class);
        if ($cargadex) {
            return $cargadex;
        }
        return [
            new CargadexObject()
        ];
    }

    /**
     * @param $post
     * @return array
     * @throws Exception
     */
    public function clientePick($post): array
    {
        $cliente = filter_var($post['cliente'], FILTER_SANITIZE_STRING);
        if (isset($post['fecha_de_actualizacion'])) {
            $fecha_de_actualizacion = filter_var($post['fecha_de_actualizacion'], FILTER_SANITIZE_STRING);
        } else {
            $fecha_de_actualizacion = date('Y-m-d');
        }
        $this->clearCargadex($cliente);
        $filename = filter_var($post['filename'], FILTER_SANITIZE_STRING);
        list($data, $header, $num) = $this->getHeaderDataCSV($filename);
        return array($cliente, $post, $fecha_de_actualizacion, $filename, $header, $data, $num);
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
    public function countCargadex(string $cliente)
    {
        $query = "select count(1) as cnt from cargadex where cliente = :cliente";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':cliente', $cliente);
        $stc->execute();
        $result = $stc->fetch(PDO::FETCH_ASSOC);
        return (int)$result['cnt'];
    }

    public function to_utf8(array $in)
    {
        $out = [];
        foreach ($in as $row) {
            $temp = [];
            foreach ($row as $item) {
                $temp[] = utf8_encode($item);
            }
            $out[] = $temp;
        }
        return $out;
    }

    /**
     * @param $filename
     * @return array
     * @throws Exception
     */
    private function getHeaderDataCSV($filename): array
    {
        $data = [];
        try {
            $handle = fopen($filename, "r");
            $header = fgetcsv($handle, 0, ",");
            while ($row = fgetcsv($handle, 0, ",")) {
                $data[] = $row;
            }
            fclose($handle);
        } catch (Exception $e) {
            throw new Exception($e);
        }
        $num = 0;
        while ($num == 0) {
            $num = count($header);
        }
        return array($data, $header, $num);
    }
}

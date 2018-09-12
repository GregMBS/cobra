<?php
namespace App;

use Exception;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CargaClass
 *
 * @author gmbs
 */
class CargaClass extends BaseClass
{

    /**
     * 
     * @var array
     */
    private $CobraFields;

    public function __construct() {
        parent::__construct();
        $this->CobraFields = $this->getDBColumnNames();
    }
    
    /**
     *
     * @return array
     */
    private function getDBColumnNames()
    {
        $columnArray = array();
        $query = "SHOW COLUMNS FROM resumen";
        $result = $this->pdo->query($query);
        foreach ($result as $row) {
            $columnArray[] = $row['Field'];
        }
        return $columnArray;
    }

    /**
     *
     * @param array $array
     * @return boolean
     */
    public function hasDuplicates(array $array)
    {
        if (count(array_unique($array)) < count($array)) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @param array $dataNames
     * @return boolean
     */
    public function badName(array $dataNames)
    {
        $ok = false;
        foreach ($dataNames as $name) {
            $match = in_array($name, $this->CobraFields);
            if (!$match) {
                $ok = true;
            }
        }
        return $ok;
    }

    /**
     *
     * @param array $columnNames
     * @throws Exception
     */
    public function prepareTemp(array $columnNames)
    {
        $queryDrop = "DROP TABLE IF EXISTS temp";
        try {
            $this->pdo->query($queryDrop);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $queryStart = "CREATE TABLE temp " . "ENGINE=INNODB AUTO_INCREMENT=10 " . "DEFAULT CHARSET=utf8 " . "COLLATE=utf8_spanish_ci " . "SELECT " . implode(',', $columnNames) . " FROM resumen LIMIT 0";
        try {
            $this->pdo->query($queryStart);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $queryIndex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50))";
        try {
            $this->pdo->query($queryIndex);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * 
     * @param array $data
     * @param array $columnNames
     * @throws Exception
     * @return number
     */
    public function loadData(array $data, array $columnNames)
    {
        /** @noinspection SyntaxError */
        $queryLoadFront = "INSERT INTO" . " temp (";
        $queryLoadEnd =") VALUES ";
        $queryLoad = $queryLoadFront . implode(",", $columnNames) . $queryLoadEnd;
        foreach ($data as $row) {
            if (is_array($row)) {
                $clean = array_map('trim', $row);
                $string = implode("','", $clean);
                $queryLoad .= "('" . $string . "'),";
            }
        }
        $queryLoadTrim = rtrim($queryLoad, ",");
        try {
            $stl = $this->pdo->prepare($queryLoadTrim);
            $stl->execute();
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        return $stl->rowCount();
    }

    /**
     *
     * @param array $columnNames
     * @return string
     */
    protected function prepareUpdate($columnNames)
    {
        $output = array();
        foreach ($columnNames as $name) {
            $output[] = 'resumen.' . $name . '=temp.' . $name;
        }
        return implode(',', $output);
    }

    /**
     * 
     * @param array $columnNames
     * @throws Exception
     * @return number
     */
    public function updateResumen(array $columnNames)
    {
        $fields = $this->prepareUpdate($columnNames);
        /** @noinspection SyntaxError */
        $queryUpdateStart = "UPDATE temp, resumen " . " SET ";
        $queryUpdateEnd = " WHERE temp.numero_de_cuenta=resumen.numero_de_cuenta";
        $queryUpdate = $queryUpdateStart . $fields . $queryUpdateEnd;
        try {
            $stu = $this->pdo->prepare($queryUpdate);
            $stu->execute();
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        return $stu->rowCount();
    }

    /**
     * 
     * @param array $columnNames
     * @throws Exception
     * @return number
     */
    public function insertIntoResumen(array $columnNames)
    {
        $fields = implode(',', $columnNames);
        $query = "insert ignore into resumen ($fields) select $fields from temp";

        try {
            $sti = $this->pdo->prepare($query);
            $sti->execute();
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        return $sti->rowCount();
    }

    /**
     */
    public function updateClientes()
    {
        $query = "INSERT IGNORE INTO clientes SELECT cliente FROM resumen";
        $this->pdo->query($query);
    }

    /**
     */
    public function updatePagos()
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
and fecha_de_ultimo_pago<fecha_de_actualizacion 
group by id_cuenta,c_cvge having fecha_de_ultimo_pago>min(d_fech)
";
        $this->pdo->query($query);
    }

    /**
     *
     * @return string[]
     */
    public function listClientes()
    {
        $result = Cliente::all()->toArray();
        return $result;
    }
}

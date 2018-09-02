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
        } else {
            return false;
        }
    }

    /**
     * 
     * @param array $datanames
     * @return boolean
     */
    public function badName(array $datanames)
    {
        $ok = false;
        foreach ($datanames as $name) {
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
        $querydrop = "DROP TABLE IF EXISTS temp";
        try {
            $this->pdo->query($querydrop);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $querystart = "CREATE TABLE temp " . "ENGINE=INNODB AUTO_INCREMENT=10 " . "DEFAULT CHARSET=utf8 " . "COLLATE=utf8_spanish_ci " . "SELECT " . implode(',', $columnNames) . " FROM resumen LIMIT 0";
        try {
            $this->pdo->query($querystart);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $queryindex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50))";
        try {
            $this->pdo->query($queryindex);
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
        $queryloadfront = "INSERT INTO" . " temp (";
        $queryloadend =") VALUES ";
        $queryload = $queryloadfront . implode(",", $columnNames) . $queryloadend;
        foreach ($data as $row) {
            if (is_array($row)) {
                $clean = array_map('trim', $row);
                $string = implode("','", $clean);
                $queryload .= "('" . $string . "'),";
            }
        }
        $queryloadtrim = rtrim($queryload, ",");
        try {
            $stl = $this->pdo->prepare($queryloadtrim);
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
        $queryupdstart = "UPDATE temp, resumen " . " SET ";
        $queryupdend = " WHERE temp.numero_de_cuenta=resumen.numero_de_cuenta";
        $queryupd = $queryupdstart . $fields . $queryupdend;
        try {
            $stu = $this->pdo->prepare($queryupd);
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
        /** @var string $queryins */
        $queryins = "insert ignore into resumen ($fields) select $fields from temp";

        try {
            $sti = $this->pdo->prepare($queryins);
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
        $querypagoins = "insert ignore into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
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
        $this->pdo->query($querypagoins);
    }

    /**
     *
     * @return string[]
     */
    public function listClientes()
    {
        $bc = new BuscarClass();
        $result = $bc->listClients();
        return $result;
    }
}

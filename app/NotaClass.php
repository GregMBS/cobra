<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App;

/**
 * Description of NotaClass
 *
 * @author gmbs
 */
class NotaClass extends BaseClass
{

    /**
     *
     * @var string
     */
    private $notesQuery = "select min(concat_ws(' ',fecha,hora)<now()) as alert,
            min(concat_ws(' ',fecha,hora)) as fechahora
from notas
where c_cvge = :capt
AND borrado=0
and fecha<>'0000-00-00'
AND concat_ws(' ',fecha,hora)<now()
ORDER BY fecha, hora LIMIT 1";

    /**
     *
     * @var string
     */
    private $notasDataQuery = "select cuenta,nota,fuente
from notas
where c_cvge IN (:capt,'todos')
AND borrado=0
AND concat(fecha,' ',hora) = :fechahora
LIMIT 1";

    /**
     *
     * @param string $capt
     * @param int $C_CONT
     */
    public function softDeleteNotas($capt, $C_CONT)
    {
        $querybor = "UPDATE notas SET borrado=1
WHERE c_cvge=:capt and c_cont=:C_CONT";
        $stb = $this->pdo->prepare($querybor);
        $stb->bindParam(':capt', $capt);
        $stb->bindParam(':C_CONT', $C_CONT);
        $stb->execute();
    }

    /**
     *
     * @param string $capt
     * @param int $AUTO
     */
    public function softDeleteOneNota($capt, $AUTO)
    {
        $querybins = "UPDATE notas set borrado=1 " . "where AUTO=:AUTO and C_CVGE=:capt";
        $stbi = $this->pdo->prepare($querybins);
        $stbi->bindParam(':capt', $capt);
        $stbi->bindParam(':AUTO', $AUTO, \PDO::PARAM_INT);
        $stbi->execute();
    }

    /**
     *
     * @param int $AUTO
     */
    public function softDeleteOneNotaAdmin($AUTO)
    {
        $querybins = "UPDATE notas set borrado=1 " . "where AUTO=:AUTO";
        $stbi = $this->pdo->prepare($querybins);
        $stbi->bindParam(':AUTO', $AUTO, \PDO::PARAM_INT);
        $stbi->execute();
    }

    /**
     *
     * @param string $capt
     * @param string $D_FECH
     * @param string $C_HORA
     * @param string $FECHA
     * @param string $HORA
     * @param string $NOTA
     * @param string $CUENTA
     * @param int $C_CONT
     * @return int
     */
    public function insertNota($capt, $D_FECH, $C_HORA, $FECHA, $HORA, $NOTA, $CUENTA, $C_CONT)
    {
        $queryins = "INSERT INTO notas
        (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT)
VALUES (:capt, :capt, date(:D_FECH), :C_HORA, :FECHA, :HORA, :NOTA,
:CUENTA, :C_CONT)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':D_FECH', $D_FECH);
        $sti->bindParam(':C_HORA', $C_HORA);
        $sti->bindParam(':FECHA', $FECHA);
        $sti->bindParam(':HORA', $HORA);
        $sti->bindParam(':NOTA', $NOTA);
        $sti->bindParam(':CUENTA', $CUENTA);
        $sti->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $sti->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    public function listMyNotas($capt)
    {
        $querysub = "SELECT auto,fecha,hora,nota,c_cvge,cuenta " . "FROM notas " . "WHERE c_cvge IN (:capt, 'todos') " . "AND borrado=0 ORDER BY fecha desc,hora desc";
        $sts = $this->pdo->prepare($querysub);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        $result = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @return array
     */
    public function listAllNotas()
    {
        $querysub = "SELECT auto,fecha,hora,nota,c_cvge FROM notas 
WHERE borrado=0 ORDER BY fecha desc,hora desc";
        $rowsub = $this->pdo->query($querysub);
        return $rowsub;
    }

    /**
     *
     * @param string $target
     * @param string $capt
     * @param string $FECHA
     * @param string $HORA
     * @param string $NOTA
     * @return int
     */
    public function insertNotaAdmin($target, $capt, $FECHA, $HORA, $NOTA)
    {
        $queryins = "INSERT INTO notas
            (C_CVGE, fuente, D_FECH, C_HORA, FECHA, HORA, NOTA)
            VALUES
            (:target, :capt, curdate(), curtime(), :fecha, :hora, :nota)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':target', $target);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':fecha', $FECHA);
        $sti->bindParam(':hora', $HORA);
        $sti->bindParam(':nota', $NOTA);
        $sti->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     *
     * @return array
     */
    public function listUsers()
    {
        $queryt = "SELECT iniciales FROM nombres " . "ORDER BY iniciales";
        $rowt = $this->pdo->query($queryt);
        return $rowt;
    }

    /**
     *
     * @param string $capt
     * @param string $fechahora
     * @return array
     */
    private function notaData($capt, $fechahora)
    {
        $stn = $this->pdo->prepare($this->notasDataQuery);
        $stn->bindParam(':capt', $capt);
        $stn->bindParam(':fechahora', $fechahora);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $capt
     * @return NotaDataClass
     */
    public function notAlert($capt)
    {
        $stn = $this->pdo->prepare($this->notesQuery);
        $stn->bindParam(':capt', $capt);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        $output = new NotaDataClass();
        if (isset($result['alert'])) {
            $notaData = $this->notaData($capt, $result['fechahora']);
            $output->alert = $result['alert'];
            $output->alertt = $result['fechahora'];
            $output->cuenta = $notaData['cuenta'];
            $output->nota = $notaData['nota'];
            $output->fuente = $notaData['fuente'];
        }
        ;
        return $output;
    }

    /**
     * 
     * @param int $id_cuenta
     * @return string
     */
    public function getCuentaFromId($id_cuenta = 0)
    {
        $cuenta = '';
        if ($id_cuenta > 0) {
            $query = "SELECT numero_de_cuenta FROM resumen 
                    WHERE id_cuenta = :id_cuenta";
            $stq = $this->pdo->prepare($query);
            $stq->bindParam(':id_cuenta', $id_cuenta);
            $stq->execute();
            $result = $stq->fetch(\PDO::FETCH_ASSOC);
            $cuenta = $result['numero_de_cuenta'];
        }
        return $cuenta;
    }
}

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
        $query = "UPDATE notas SET borrado=1
WHERE c_cvge=:capt and c_cont=:C_CONT";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':capt', $capt);
        $stb->bindValue(':C_CONT', $C_CONT);
        $stb->execute();
    }

    /**
     *
     * @param string $capt
     * @param int $AUTO
     */
    public function softDeleteOneNota($capt, $AUTO)
    {
        $query = "UPDATE notas set borrado=1 " . "where AUTO=:AUTO and C_CVGE=:capt";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':capt', $capt);
        $stb->bindValue(':AUTO', $AUTO, \PDO::PARAM_INT);
        $stb->execute();
    }

    /**
     *
     * @param int $AUTO
     */
    public function softDeleteOneNotaAdmin($AUTO)
    {
        $query = "UPDATE notas set borrado=1 " . "where AUTO=:AUTO";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':AUTO', $AUTO, \PDO::PARAM_INT);
        $stb->execute();
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
        $query = "INSERT INTO notas
        (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT)
VALUES (:capt, :capt, date(:D_FECH), :C_HORA, :FECHA, :HORA, :NOTA,
:CUENTA, :C_CONT)";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':capt', $capt);
        $sti->bindValue(':D_FECH', $D_FECH);
        $sti->bindValue(':C_HORA', $C_HORA);
        $sti->bindValue(':FECHA', $FECHA);
        $sti->bindValue(':HORA', $HORA);
        $sti->bindValue(':NOTA', $NOTA);
        $sti->bindValue(':CUENTA', $CUENTA);
        $sti->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
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
        $query = "SELECT auto,fecha,hora,nota,c_cvge,cuenta " . "FROM notas " . "WHERE c_cvge IN (:capt, 'todos') " . "AND borrado=0 ORDER BY fecha desc,hora desc";
        $sts = $this->pdo->prepare($query);
        $sts->bindValue(':capt', $capt);
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
        $query = "SELECT auto,fecha,hora,nota,c_cvge FROM notas 
WHERE borrado=0 ORDER BY fecha desc,hora desc";
        $row = $this->pdo->query($query);
        return $row->fetchAll(\PDO::FETCH_ASSOC);
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
        $query = "INSERT INTO notas
            (C_CVGE, fuente, D_FECH, C_HORA, FECHA, HORA, NOTA)
            VALUES
            (:target, :capt, CURDATE(), CURTIME(), :fecha, :hora, :nota)";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':target', $target);
        $sti->bindValue(':capt', $capt);
        $sti->bindValue(':fecha', $FECHA);
        $sti->bindValue(':hora', $HORA);
        $sti->bindValue(':nota', $NOTA);
        $sti->execute();
        return $this->pdo->lastInsertId();
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
        $stn->bindValue(':capt', $capt);
        $stn->bindValue(':fechahora', $fechahora);
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
        $stn->bindValue(':capt', $capt);
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
}

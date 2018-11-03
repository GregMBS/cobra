<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App;

/**
 * Description of NoteClass
 *
 * @author gmbs
 */
class NoteClass extends BaseClass
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
    private $notesDataQuery = "select cuenta,nota,fuente
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
    public function softDeleteNotes($capt, $C_CONT)
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
    public function softDeleteOneNote($capt, $AUTO)
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
    public function softDeleteOneNoteAdmin($AUTO)
    {
        $query = "UPDATE notas set borrado=1 " . "where AUTO=:AUTO";
        $stb = $this->pdo->prepare($query);
        $stb->bindValue(':AUTO', $AUTO, \PDO::PARAM_INT);
        $stb->execute();
    }

    /**
     *
     * @param string $capt
     * @param string $today
     * @param string $now
     * @param string $date
     * @param string $time
     * @param string $note
     * @param string $account
     * @param int $id
     * @return int
     */
    public function insertNote($capt, $today, $now, $date, $time, $note, $account, int $id)
    {
        $query = "INSERT INTO notas
        (C_CVGE, fuente, D_FECH, C_HORA, FECHA, HORA, NOTA, CUENTA, C_CONT)
VALUES (:capt, :capt, date(:today), :now, :date, :time, :note, :account, :id)";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':capt', $capt);
        $sti->bindValue(':today', $today);
        $sti->bindValue(':now', $now);
        $sti->bindValue(':date', $date);
        $sti->bindValue(':time', $time);
        $sti->bindValue(':note', $note);
        $sti->bindValue(':account', $account);
        $sti->bindValue(':id', $id, \PDO::PARAM_INT);
        $sti->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    public function listMyNotes($capt)
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
    public function listAllNotes()
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
     * @param string $date
     * @param string $time
     * @param string $note
     * @return int
     */
    public function insertNoteAdmin($target, $capt, $date, $time, $note)
    {
        $query = "INSERT INTO notas
            (C_CVGE, fuente, D_FECH, C_HORA, FECHA, HORA, NOTA)
            VALUES
            (:target, :capt, CURDATE(), CURTIME(), :date, :time, :note)";
        $sti = $this->pdo->prepare($query);
        $sti->bindValue(':target', $target);
        $sti->bindValue(':capt', $capt);
        $sti->bindValue(':date', $date);
        $sti->bindValue(':time', $time);
        $sti->bindValue(':note', $note);
        $sti->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     *
     * @param string $capt
     * @param string $dateTime
     * @return array
     */
    private function noteData($capt, $dateTime)
    {
        $stn = $this->pdo->prepare($this->notesDataQuery);
        $stn->bindValue(':capt', $capt);
        $stn->bindValue(':fechahora', $dateTime);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $capt
     * @return NoteDataClass
     */
    public function noteAlert($capt)
    {
        $stn = $this->pdo->prepare($this->notesQuery);
        $stn->bindValue(':capt', $capt);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        $output = new NoteDataClass();
        if (isset($result['alert'])) {
            $noteData = $this->noteData($capt, $result['fechahora']);
            $output->alert = $result['alert'];
            $output->alertText = $result['fechahora'];
            $output->account = $noteData['cuenta'];
            $output->note = $noteData['nota'];
            $output->source = $noteData['fuente'];
        }
        ;
        return $output;
    }
}

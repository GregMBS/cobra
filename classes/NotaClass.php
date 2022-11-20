<?php

namespace cobra_salsa;

use PDO;

/**
 * Description of NotaClass
 *
 * @author gmbs
 */
class NotaClass {

    /**
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $capt
     * @param int $C_CONT
     */
    public function softDeleteNotas(string $capt, int $C_CONT): void
    {
        $query = "UPDATE notas SET borrado=1
WHERE c_cvge=:capt and c_cont=:C_CONT";
        $stb = $this->pdo->prepare($query);
        $stb->bindParam(':capt', $capt);
        $stb->bindParam(':C_CONT', $C_CONT);
        $stb->execute();
    }

    /**
     * 
     * @param string $capt
     * @param int $AUTO
     */
    public function softDeleteOneNota(string $capt, int $AUTO): void
    {
        $query = "UPDATE notas set borrado=1 
        where AUTO=:AUTO and C_CVGE=:capt";
        $stb = $this->pdo->prepare($query);
        $stb->bindParam(':capt', $capt);
        $stb->bindParam(':AUTO', $AUTO, PDO::PARAM_INT);
        $stb->execute();
    }

    /**
     * 
     * @param int $AUTO
     */
    public function softDeleteOneNotaAdmin(int $AUTO): void
    {
        $query = "UPDATE notas set borrado=1 
        where AUTO=:AUTO";
        $stb = $this->pdo->prepare($query);
        $stb->bindParam(':AUTO', $AUTO, PDO::PARAM_INT);
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
     */
    public function insertNota(string $capt, string $D_FECH, string $C_HORA, string $FECHA, string $HORA, string $NOTA, string $CUENTA, int $C_CONT): void
    {
        $query = "INSERT INTO notas
        (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT)
VALUES (:capt, :capt, date(:D_FECH), :C_HORA, :FECHA, :HORA, :NOTA,
:CUENTA, :C_CONT)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':D_FECH', $D_FECH);
        $sti->bindParam(':C_HORA', $C_HORA);
        $sti->bindParam(':FECHA', $FECHA);
        $sti->bindParam(':HORA', $HORA);
        $sti->bindParam(':NOTA', $NOTA);
        $sti->bindParam(':CUENTA', $CUENTA);
        $sti->bindParam(':C_CONT', $C_CONT, PDO::PARAM_INT);
        $sti->execute();
    }

    /**
     * 
     * @param string $capt
     * @return array
     */
    public function listMyNotas(string $capt): array
    {
        $query = "SELECT auto,fecha,hora,nota,c_cvge,cuenta 
        FROM notas 
        WHERE c_cvge IN (:capt, 'todos') 
        AND borrado=0 ORDER BY fecha desc,hora desc";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        return $sts->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function listAllNotas(): array
    {
        $query = "SELECT auto,fecha,hora,nota,c_cvge 
        FROM notas 
        WHERE borrado=0 ORDER BY fecha desc,hora desc";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $target
     * @param string $capt
     * @param string $FECHA
     * @param string $HORA
     * @param string $NOTA
     */
    public function insertNotaAdmin(string $target, string $capt, string $FECHA, string $HORA, string $NOTA): void
    {
        $query = "INSERT INTO notas
            (C_CVGE, fuente, D_FECH, C_HORA, FECHA, HORA, NOTA, c_cont)
            VALUES
            (:target, :capt, curdate(), curtime(), :fecha, :hora, :nota, 0)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':target', $target);
        $sti->bindParam(':capt', $capt);
        $sti->bindParam(':fecha', $FECHA);
        $sti->bindParam(':hora', $HORA);
        $sti->bindParam(':nota', $NOTA);
        $sti->execute();
    }

    /**
     * 
     * @return array
     */
    public function listUsers(): array
    {
        $query = "SELECT iniciales FROM nombres ORDER BY iniciales";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}

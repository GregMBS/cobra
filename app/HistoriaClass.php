<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of GestionClass
 *
 * @author gmbs
 */
class HistoriaClass extends BaseClass {

    private function fillGaps() {
        $query = "update resumen,historia
set c_cont=id_cuenta,c_cvba=cliente
where cuenta=numero_de_cuenta
and c_cvba is null";
        $this->pdo->query($query);
    }

    /**
     * 
     * @param string $cuenta
     * @return int
     */
    private function getIdCuenta($cuenta) {
        $query = <<<SQL
SELECT id_cuenta FROM resumen 
        WHERE numero_de_cuenta = :cuenta 
        LIMIT 1
SQL;
        /* var $sti PDOStatement */
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':cuenta', $cuenta);
        $sti->execute();
        $result = $sti->fetch(\PDO::FETCH_ASSOC);
        return $result['id_cuenta'];
    }
    
    /**
     * 
     * @param array $gestiones
     */
    private function unsafeInsert(array $gestiones) {
        $columns = array_keys($gestiones[0]);
        $columnText = implode(",", $columns);
        $start = 'INSERT ';
        $start2 = 'INTO ';
        $start3 = 'historia';
        $middle = " VALUES";
        $query = $start . $start2 . $start3 . " (" . $columnText . ")" . $middle;
        $querytail = " ('%s'),";
        foreach ($gestiones as $gest) {
            if (!empty($gest)) {
                // $gestText = implode("','", $gest);
                $data = vsprintf($querytail, $gest);
                $query .= $data;
            }
        }
        $clean = trim($query, ',');
        $stc = $this->pdo->prepare($clean);
        $stc->execute();
    }

    public function insertGestiones($gestiones) {
        $this->unsafeInsert($gestiones);
        $id_cuenta = $this->getIdCuenta($gestiones['CUENTA']);
        $this->fillGaps();
        $this->addNewTel($id_cuenta, $gestiones['C_NTEL']);
    }

    /**
     * 
     * @param int $C_CONT
     * @param string $tele
     */
    public function addNewTel($C_CONT, $tele) {
        $tel = filter_var($tele, FILTER_SANITIZE_NUMBER_INT);
        $queryntel = "UPDATE resumen "
                . "SET tel_4_verif = tel_3_verif,"
                . "tel_3_verif = tel_2_verif,"
                . "tel_2_verif = tel_1_verif,"
                . "tel_1_verif = :tel "
                . "WHERE id_cuenta = :C_CONT";
        $stn = $this->pdo->prepare($queryntel);
        $stn->bindParam(':tel', $tel);
        $stn->bindParam(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
    }

}

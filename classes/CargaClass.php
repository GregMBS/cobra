<?php

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
class CargaClass {

    /**
     *
     * @var PDO
     */
    private $pdo;
    
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    /**
     * 
     * @return string
     */
    function moveLoadedFile() {
        $deststr = "/tmp/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
        return $deststr;
    }

    function clearCargadex($cliente) {
                $queryclean = "delete from cargadex where cliente = :cliente";
                $stc = $this->pdo->prepare($queryclean);
                $stc->bindParam(':cliente', $cliente);
    }
}

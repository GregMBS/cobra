<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userCheckClass
 *
 * @author gmbs
 */
class userCheckClass
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function userCheck()
    {
        $capt = filter_input(INPUT_GET, 'capt');
        $ticket = filter_input(INPUT_COOKIE, 'auth');
        $querycheck="SELECT count(1) as 'check', max(tipo) as 'mytipo'"
            . "FROM cobra.nombres "
            . "WHERE ticket=:ticket AND iniciales=:capt;";
        $stc = $this->pdo->prepare($querycheck);
        $stc->bindParam(':ticket', $ticket);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
        $results=$stc->fetch(PDO::FETCH_ASSOC);
        if ($results['check']==0) {
            $redirect = 'location: index.php';
            header($redirect);
        }
        return $results['mytipo'];
    }
}
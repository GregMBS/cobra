<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RobotClass
 *
 * @author gmbs
 */
class RobotClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    /**
     * 
     * @param pdoConnect $pdoc
     */
    public function __construct($pdoc) {
        $this->pdo = $pdoc->dbConnectRobot();
    }

    /**
     * 
     * @return array
     */
    public function getMessageList() {
        $querycl = "SELECT client,tipo FROM msglist";
        $resultcl = $this->pdo->query($querycl);
        return $resultcl;
    }

    private function createTemp() {
        $querytemp1 = 'DROP TABLE IF EXISTS tempc';
        $this->pdo->query($querytemp1);
        $querytemp2 = 'CREATE TABLE tempc (
  `id` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `turno` varchar(50)
)';
        $this->pdo->query($querytemp2);
    }

    /**
     * 
     * @param string $datastring
     * @return array
     */
    private function dataPrep($datastring) {
        $data0 = preg_replace('/[^0-9a-zA-Z]/', ',', $datastring);
        $data1 = preg_replace('/\,\,/', ',', $data0);
        $data = explode(',', $data1);
        return $data;
    }

    /**
     * 
     * @param array $data
     */
    private function loadTemp($data) {
        $max = ceil(count($data) / 2);
        $queryload = 'INSERT INTO tempc (id,tel) VALUES (:id, :tel)';
        $stl = $this->pdo->prepare($queryload);
        for ($i = 0; $i < $max; $i++) {
            $a = $i * 2;
            $b = $i * 2 + 1;
            $stl->bindParam(':id', $data[$a]);
            $stl->bindParam(':tel', $data[$b]);
            $stl->execute();
        }
    }

    private function loadCalllist($msgtag) {
        $queryput = "INSERT IGNORE INTO calllist (id,tel,msg,turno)
SELECT id,tel,msg,0 FROM tempc left join (select msg from msglist 
where concat_ws(',',client,tipo)=:msgtag) as tmp on 1=1
;";
        $stp = $this->pdo->prepare($queryput);
        $stp->bindParam(':msgtag', $msgtag);
        $stp->execute();
    }

    /**
     * 
     * @param string $datastring
     * @param string $msgtag
     */
    public function loadRobot($datastring, $msgtag) {
        $data = $this->dataPrep($datastring);
        $this->createTemp();
        $this->loadTemp($data);
        $this->loadCalllist($msgtag);
    }

    public function stopAllQueues() {
        $queryk = "UPDATE msglist 
SET lineas=0";
        $this->pdo->query($queryk);
    }

    public function eraseAllQueues() {
        $queryk = "TRUNCATE calllist";
        $this->pdo->query($queryk);
    }

    public function resetCounter() {
        $queryk = "UPDATE calllist 
SET turno=0";
        $this->pdo->query($queryk);
    }

    /**
     * 
     * @param int $auto
     * @param int $lineas
     */
    public function changeLineCount($auto, $lineas) {
        $queryu = "UPDATE msglist 
		SET lineas = :lineas
		WHERE auto = :auto";
        $stq = $this->pdo->prepare($queryu);
        $stq->bindParam(':lineas', $lineas, PDO::PARAM_INT);
        $stq->bindParam(':auto', $auto, PDO::PARAM_INT);
        $stq->execute();
    }

    /**
     * 
     * @param int $auto
     */
    public function eraseOneQueue($auto) {
        $queryu = "DELETE FROM calllist
                WHERE auto = :auto";
        $stq = $this->pdo->prepare($queryu);
        $stq->bindParam(':auto', $auto, PDO::PARAM_INT);
        $stq->execute();
    }

    public function getReport() {
        $queryk = "select rc.msg as 'msg', count(distinct trim(id)) as 'countid',
            count(distinct tel) as 'counttel', lineas, 
            sum(turno>0)/count(1)*100 as percent, sum(1) as total
from calllist rc 
join msglist rm 
on rc.msg regexp rm.msg
group by rc.msg";
        $result = $this->pdo->query($queryk);
        $output = $this->calcTiempo($result);
        return $result;
    }

    /**
     * 
     * @param array $array
     * @return array
     */
    private function calcTiempo($array) {
        $output = array();
        if (is_array($array)) {
            foreach ($array as $row) {
                $temp = $row;
                if ($row['lineas'] > 0) {
                    $rest = (100 - $row['percent']) / 100 * $row['total'] / 60 / $row['lineas'];
                    $resth = floor($rest);
                    $restm = sprintf('%02d', round(($rest - $resth) * 60));
                    $temp['tiempo'] = $resth . ":" . $restm;
                } else {
                    $temp['tiempo'] = 'N/A';
                }
                $output[] = $temp;
            }
        }
        return $output;
    }

    /**
     * 
     * @return array
     */
    public function getQueues() {
        $query = "SELECT msg,lineas,auto FROM msglist 
ORDER BY msg";
        $result = $this->pdo->query($query);
        return $result;
    }

}

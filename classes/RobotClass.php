<?php

namespace cobra_salsa;

use ConfigClass;
use PDO;

require_once 'classes/BaseClass.php';

/**
 * Description of RobotClass
 *
 * @author gmbs
 */
class RobotClass extends BaseClass {

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        parent::__construct($pdo);
        $config = new ConfigClass();
        $pdo->query('use '.$config->robotDb);
    }

    /**
     * 
     * @return array
     */
    public function getMessageList() {
        $query = "SELECT client,tipo FROM msglist";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    private function createTemp() {
        $query1 = 'DROP TABLE IF EXISTS temp_calls';
        $this->pdo->query($query1);
        $query2 = 'CREATE TABLE temp_calls (
  `id` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `turno` varchar(50)
)';
        $this->pdo->query($query2);
    }

    /**
     * 
     * @param string $dataString
     * @return array
     */
    private function dataPrep($dataString) {
        $data0 = preg_replace('/[^0-9a-zA-Z]/', ',', $dataString);
        $data1 = preg_replace('/,,/', ',', $data0);
        return explode(',', $data1);
    }

    /**
     * 
     * @param array $data
     */
    private function loadTemp($data) {
        $max = ceil(count($data) / 2);
        $query = 'INSERT INTO temp_calls (id,tel) VALUES (:id, :tel)';
        $stl = $this->pdo->prepare($query);
        for ($i = 0; $i < $max; $i++) {
            $first = $i * 2;
            $second = $i * 2 + 1;
            $stl->bindParam(':id', $data[$first]);
            $stl->bindParam(':tel', $data[$second]);
            $stl->execute();
        }
    }

    private function loadCalllist($msgtag) {
        $query = "INSERT IGNORE INTO calllist (id,tel,msg,turno)
SELECT id,tel,msg,0 FROM temp_calls left join (select msg from msglist 
where concat_ws(',',client,tipo)=:msgtag) as tmp on 1=1
;";
        $stp = $this->pdo->prepare($query);
        $stp->bindParam(':msgtag', $msgtag);
        $stp->execute();
    }

    /**
     * 
     * @param string $dataString
     * @param string $msgtag
     */
    public function loadRobot($dataString, $msgtag) {
        $data = $this->dataPrep($dataString);
        $this->createTemp();
        $this->loadTemp($data);
        $this->loadCalllist($msgtag);
    }

    public function stopAllQueues() {
        $query = "UPDATE msglist 
SET lineas=0";
        $this->pdo->query($query);
    }

    public function eraseAllQueues() {
        $query = "TRUNCATE calllist";
        $this->pdo->query($query);
    }

    public function resetCounter() {
        $query = "UPDATE calllist 
SET turno=0";
        $this->pdo->query($query);
    }

    /**
     * 
     * @param int $auto
     * @param int $lineas
     */
    public function changeLineCount($auto, $lineas) {
        $query = "UPDATE msglist 
		SET lineas = :lineas
		WHERE auto = :auto";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':lineas', $lineas, PDO::PARAM_INT);
        $stq->bindParam(':auto', $auto, PDO::PARAM_INT);
        $stq->execute();
    }

    /**
     * 
     * @param int $auto
     */
    public function eraseOneQueue($auto) {
        $query = "DELETE FROM calllist
                WHERE auto = :auto";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':auto', $auto, PDO::PARAM_INT);
        $stq->execute();
    }

    /**
     * @return array
     */
    public function getReport() {
        $query = "select rc.msg as 'msg', count(distinct trim(id)) as 'count_id',
            count(distinct tel) as 'count_tel', lineas, 
            sum(turno>0)/count(1)*100 as percent, sum(1) as total
from calllist rc 
join msglist rm 
on rc.msg regexp rm.msg
group by rc.msg";
        $stk = $this->pdo->query($query);
        $stk->execute();
        $result = $stk->fetchAll(PDO::FETCH_ASSOC);
        return $this->calcTiempo($result);
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
                $temp['tiempo'] = 'N/A';
                if ($row['lineas'] > 0) {
                    $rest = (100 - $row['percent']) / 100 * $row['total'] / 60 / $row['lineas'];
                    $restHour = floor($rest);
                    $restMin = sprintf('%02d', round(($rest - $restHour) * 60));
                    $temp['tiempo'] = $restHour . ":" . $restMin;
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
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}

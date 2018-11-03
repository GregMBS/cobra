<?php
/**
 * Created by PhpStorm.
 * User: gmbs
 * Date: 8/29/18
 * Time: 4:59 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Builder;

class UserClass extends BaseClass
{
    /**
     *
     * @return array
     */
    public function listUsers()
    {
        $query = "SELECT iniciales FROM users
                    WHERE tipo <> ''
                UNION
                SELECT iniciales FROM nombres
                    WHERE tipo <> ''";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $agents = array_column($result, 'iniciales');
        return $agents;
    }

    /**
     *
     * @return array
     */
    public function getVisitors()
    {
        $query = "SELECT iniciales,completo FROM users where tipo IN ('visitador','admin')";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param int $camp
     * @param string $capt
     */
    public function setCamp($camp, $capt) {
        $query = "UPDATE users SET camp=:camp "
            . "where iniciales=:capt";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':camp', $camp);
        $stu->bindValue(':capt', $capt);
        $stu->execute();
    }

    /**
     *
     * @param string $capt
     * @return int
     */
    public function getCamp($capt) {
        try {
            /** @var Builder $query */
            $query = User::whereIniciales($capt);
            /** @var User $user */
            $user= $query->firstOrFail();
            $camp = $user->camp;
        } catch (\Exception $e) {
            $camp = 0;
        }
        return $camp;
    }

}
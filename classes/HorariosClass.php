<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/TimesheetClass.php';
require_once __DIR__ . '/TimesheetDayObject.php';

class HorariosClass extends TimesheetClass
{

    protected $queryGestores = 'select distinct c_cvge from historia, nombres
            where d_fech>last_day(curdate() - interval 1 month)
            and c_cvge = iniciales
            order by c_cvge limit 1000';

    protected $queryVisitadores = 'select distinct c_visit
    from historia
where d_fech > last_day(curdate()-interval 1 month)
order by c_visit
limit 1000';

    protected $queryStartStopDiff = "select min(C_HRIN) as start, max(C_HRFI) as stop,
            time_to_sec(timediff(max(C_HRFI),min(C_HRIN))) as diff
            from historia
            where c_cvge=:gestor and c_msge is null
            and c_cniv is null
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            group by D_FECH";

    protected $queryCurrentMain = "select count(distinct c_cont) as cuentas,
            sum(n_prom > 0) as promesas,
            count(1) as gestiones,
            count(1) - sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_cvge=:gestor and c_msge is null
            and c_cniv is null and c_cont>0
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            group by D_FECH";

    protected $queryVisitMain = "select count(distinct c_cont) as cuentas,
            sum(n_prom > 0) as promesas,
            count(1) as gestiones,
            count(1) - sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_visit=:gestor and c_msge is null
            and c_cniv <> '' and c_cont>0
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            group by D_FECH";

    protected $queryTiempoDiff = "select c_hrin as tiempo,
            time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as diff
            from historia
            where c_cont=0 and c_cvge=:gestor
            and d_fech=last_day(curdate() - interval 5 week) + interval :dom day
            and c_cvst=:tipo
            order by c_cvge,c_cvst,c_hrin";

    protected $queryNTPDiff = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as diff,
            min(c_hrin) as ntp
            from historia
            where c_cvge = :gestor
            and d_fech = last_day(curdate() - interval 5 week) + interval :dow day
            and c_hrin>:tiempo";

    protected $queryPagos = "select count(1) as ct from pagos
            where gestor=:gestor
            and fecha=last_day(curdate() - interval 1 month) + interval :dom day";

    protected $queryCountVisitadorDays = "select sum(fs) as sfs,sum(ss) as sss from
(select distinct d_fech,dayofweek(d_fech)>1 and day(d_fech)<16 as fs,
dayofweek(d_fech)>1 and day(d_fech)>15 as ss from historia
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())) as tmp";

    /**
     * @param string $visitador
     * @param int $hoy
     * @return TimesheetDayObject[]
     */
    public function prepareVisitSheet(string $visitador, int $hoy): array
    {
        $month = [];
        for ($i = 1; $i <= $hoy; $i++) {
            $day = new TimesheetDayObject();
            $resultStartStop = $this->getVisitadorMain($visitador, $i);
            foreach ($resultStartStop as $answerStartStop) {
                $this->loadDay($visitador, $i, $answerStartStop, $day);
            }
            $month[$i] = $day;
        }
        return $month;
    }

    /**
     *
     * @param string $gestor
     * @param int $dom
     * @return array
     */
    public function getVisitadorMain(string $gestor, int $dom)
    {
        $query = $this->queryVisitMain;
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }
        return [
            'cuentas' => 0,
            'promesas' => 0,
            'gestiones' => 0,
            'nocontactos' => 0,
            'contactos' => 0
        ];
    }


}

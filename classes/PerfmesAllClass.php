<?php

namespace cobra_salsa;


/**
 * Database Class for perfmes
 *
 * @author gmbs
 */
class PerfmesAllClass extends TimesheetClass
{
    protected $queryGestores = 'select distinct c_cvge from historia
            where d_fech between last_day(curdate() - interval 2 month) AND last_day(curdate() - interval 1 month)
            order by c_cvge limit 1000';

    protected $queryVisitadores = 'select distinct c_visit
    from historia
where d_fech between last_day(curdate() - interval 2 month) AND last_day(curdate() - interval 1 month)
order by c_visit';

    protected $queryCurrentMain = "select count(distinct c_cont) as cuentas,
            sum(n_prom > 0) as promesas,
            count(1) as gestiones,
            count(1) - sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where :gestor = '' and c_msge is null
            and c_cniv is null and c_cont>0
            and D_FECH=last_day(curdate() - interval 2 month) + interval :dom day
            group by D_FECH";

    protected $queryPagos = "select count(1) as ct from pagos
            where :gestor = ''
            and fecha=last_day(curdate() - interval 2 month) + interval :dom day";

    protected $queryCountAccounts = "select count(distinct c_cont) as ct
            from historia
            where :gestor = '' and c_cont>0
            and c_cniv is null and c_msge is null
            and D_FECH between last_day(curdate() - interval 2 month) AND last_day(curdate() - interval 1 month)";

    /**
     * @param $gestor
     * @param int $hoy
     * @return TimesheetDayObject[]
     */
    public function prepareSheet($gestor, $hoy): array
    {
        $month = [];
        for ($i = 1; $i <= $hoy; $i++) {
            $day = new TimesheetDayObject();
            $resultStartStop = $this->getCurrentMain($gestor, $i);
            foreach ($resultStartStop as $answerStartStop) {
                $this->breakLoop($gestor, $i, $day, 'break');
                $this->breakLoop($gestor, $i, $day, 'bano');
                $this->loadDay($gestor, $i, $answerStartStop, $day);
            }
            $month[$i] = $day;
        }
        return $month;
    }

    /**
     * @param TimesheetDayObject[] $month
     * @return TimesheetDayObject
     */
    public function prepareMonthSum(array $month)
    {
        $sum = new TimesheetDayObject();
        $sum->lla = array_sum(array_column($month, 'lla'));
        $sum->tlla = array_sum(array_column($month, 'tlla'));
        $sum->prom = array_sum(array_column($month, 'prom'));
        $sum->pag = array_sum(array_column($month, 'pag'));
        $sum->ct = array_sum(array_column($month, 'ct'));
        $sum->nct = array_sum(array_column($month, 'nct'));
        $sum->lph = $sum->lla / ($sum->diff + 1 / 3600);
        return $sum;
    }
}
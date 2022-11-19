<?php

namespace cobra_salsa;


/**
 * Database Class for perfmes
 *
 * @author gmbs
 */
class PerfmesAllClass extends TimesheetClass
{
    protected string $queryGestores = 'select distinct c_cvge from historia
            where d_fech between last_day(curdate() - interval 2 month) AND last_day(curdate() - interval 1 month)
            order by c_cvge limit 1000';

    protected string $queryVisitadores = 'select distinct c_visit
    from historia
where d_fech between last_day(curdate() - interval 2 month) AND last_day(curdate() - interval 1 month)
order by c_visit';

    protected string $queryCurrentMain = "select count(distinct c_cont) as cuentas,
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

    protected string $queryPagos = "select count(1) as ct from pagos
            where :gestor = ''
            and fecha=last_day(curdate() - interval 2 month) + interval :dom day";

    /**
     * @param string $gestor
     * @param int $hoy
     * @return TimesheetDayObject[]
     */
    public function prepareSheet(string $gestor, int $hoy): array
    {
        return $this->prepareAllSheet($gestor, $hoy);
    }

    /**
     * @param TimesheetDayObject[] $month
     * @return TimesheetDayObject
     */
    public function prepareMonthSum(array $month): TimesheetDayObject
    {
        $sum = new TimesheetDayObject();
        return $this->prepareMonthSumCounts($month, $sum);
    }
}
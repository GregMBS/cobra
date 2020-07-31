<?php

namespace cobra_salsa;

require_once __DIR__ . '/TimesheetClass.php';

class HorariosClass extends TimesheetClass
{

    protected $queryGestores = 'select distinct c_cvge from historia
            where d_fech>last_day(curdate() - interval 1 month)
            order by c_cvge limit 1000';

    protected $queryVisitadores = 'select distinct completo,iniciales
from nombres join historia on iniciales=c_visit
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
order by iniciales';

    protected $queryStartStopDiff = "select min(C_HRIN) as start, max(C_HRFI) as stop,
            time_to_sec(timediff(max(C_HRFI),min(C_HRIN))) as diff
            from historia
            where c_cvge=:gestor and c_msge is null
            and c_cniv is null
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            and c_cont=0
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

    protected $queryVisitadorMain = "select count(distinct c_cont) as cuentas,
            sum(c_cvst like 'PROMESA DE%') as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_visit=:visitador and c_msge is null
            and c_cniv is not null and c_cont>0
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

    protected $queryVisitadorPagos = "select count(distinct pagos.auto) as ct from pagos
			join historia on c_cont=id_cuenta
			where c_visit = :visitador
			and fecha>last_day(curdate()-interval 1 month)
			and fecha<=last_day(curdate())
			and day(fecha) = :dom";

    protected $queryCountVisitsAssigned = "select count(fechaout) as 'co', count(fechain) as 'ci'
			from vasign
			where gestor = :visitador
			and fechaout>last_day(curdate()-interval 1 month)
			and fechaout<last_day(curdate())+interval 1 day
			and day(fechaout) = :dom";

    protected $queryCountAccounts = "select count(distinct c_cont) as ct
            from historia
            where c_cvge=:gestor and c_cont>0
            and c_cniv is null and c_msge is null
            and D_FECH>last_day(curdate() - interval 1 month)";

    protected $queryCountVisitadorDays = "select sum(fs) as sfs,sum(ss) as sss from
(select distinct d_fech,dayofweek(d_fech)>1 and day(d_fech)<16 as fs,
dayofweek(d_fech)>1 and day(d_fech)>15 as ss from historia
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())) as tmp";

    /**
     * @param $hc
     * @param $gestor
     * @param int $hoy
     * @return TimesheetDayObject[]
     */
    public function prepareSheet($hc, $gestor, $hoy): array
    {
        $month = [];
        for ($i = 1; $i <= $hoy; $i++) {
            $day = new TimesheetDayObject();
            $resultssd = $hc->getStartStopDiff($gestor, $i);
            foreach ($resultssd as $answerssd) {
                $day->start = substr($answerssd['start'], 0, 5);
                $day->stop = substr($answerssd['stop'], 0, 5);
                $day->diff = $answerssd['diff'];
            }
            $resultss = $hc->getCurrentMain($gestor, $i);
            foreach ($resultss as $answerss) {
                $resultpo = $hc->getTiempoDiff($gestor, $i, 'bano');
                foreach ($resultpo as $answerpo) {
                    $TIEMPO = $answerpo['tiempo'];
                    $resultNTP = $hc->getNTPDiff($gestor, $i, $TIEMPO);
                    if ($resultNTP) {
                        foreach ($resultNTP as $NTP) {
                            $DIFF = $NTP['diff'];
                            $day->bano += $DIFF;
                        }
                    }
                }
                $day->lla = $answerss['cuentas'];
                $day->tlla = $answerss['gestiones'];
                $day->ct = $answerss['nocontactos'];
                $day->nct = $answerss['contactos'];
                $day->prom = $answerss['promesas'];
                $day->lph = $day->lla / ($day->diff + 1 / 3600);
                $result = $hc->getPagos($gestor, $i);
                foreach ($result as $answer) {
                    $day->pag = $answer['ct'];
                }
            }
            $month[$i] = $day;
        }
        return $month;
    }

}